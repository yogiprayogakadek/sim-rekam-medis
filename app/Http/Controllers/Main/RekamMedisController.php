<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\RekamMedisRequest;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    private function unggahDokumen($request)
    {
        if (!$request->id) {
            $kode = $request->kode;
        } else {
            $rekamMedis = RekamMedis::find($request->id);
            // dd($rekamMedis);
            $count = count(json_decode($rekamMedis->log, true)) + 1;
            $kode = $request->kode . '_' . $count;
        }
        // Dapatkan ekstensi file asli
        $fileExtension = $request->file('dokumen')->getClientOriginalExtension();
        // Buat nama file baru dengan mengganti spasi dengan tanda hubung
        $fileNameStore = str_replace(' ', '-', $kode) . '.' . $fileExtension;

        // Tentukan path penyimpanan
        $savePath = 'assets/uploads/rekam-medis/' . date('Y') . '/' . date('d-m-Y');

        // Buat direktori jika belum ada
        if (!file_exists(public_path($savePath))) {
            mkdir(public_path($savePath), 0755, true);
        }

        // Cek apakah file sudah ada
        $fullPath = public_path($savePath . '/' . $fileNameStore);
        if (file_exists($fullPath)) {
            // Jika file sudah ada, kembalikan path lengkap tanpa mengunggah lagi
            return $savePath . '/' . $fileNameStore;
        }

        // Pindahkan file ke path yang ditentukan
        $request->file('dokumen')->move(public_path($savePath), $fileNameStore);

        // Return path lengkap file yang diunggah
        return $savePath . '/' . $fileNameStore;
    }


    public function index()
    {
        return view('main.rekam-medis.index');
    }

    public function render()
    {
        $rekamMedis = RekamMedis::all();

        $view = [
            'data' => view('main.rekam-medis.render', compact('rekamMedis'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.rekam-medis.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(RekamMedisRequest $request)
    {
        // dd($request->all());
        try {
            $log[] = [
                'id' => 1,
                'user_id' => auth()->user()->id,
                'time' => now()->format('Y-m-d H:i:s'),
                'title' => 'Create',
                'content' => [
                    'kode' => 'Insert kode rekam medis ' . $request->kode,
                    // 'tanggal_unggah' => 'Insert tanggal unggah ' . now()->format('Y-m-d H:i:s'),
                    'dokumen' => $this->unggahDokumen($request)
                ]
            ];

            $rekamMedis = [
                'kode' => $request->kode,
                'user_id' => auth()->user()->id,
                // 'tanggal_unggah' => now()->format('Y-m-d H:i:s'),
                'dokumen' => $this->unggahDokumen($request),
                'log' => json_encode($log)
            ];

            RekamMedis::create($rekamMedis);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::find($id);
        $view = [
            'data' => view('main.rekam-medis.edit', compact('rekamMedis'))->render(),
        ];

        return response()->json($view);
    }

    public function update(RekamMedisRequest $request)
    {
        // dd($request->all());
        $dokumen = $request->hasFile('dokumen') ? $this->unggahDokumen($request) : 'null';
        try {
            $rekamMedis = RekamMedis::find($request->id);
            // dd($rekamMedis);
            // current log
            $rekamMedisLog = json_decode($rekamMedis->log, true);
            // dd($rekamMedisLog);
            // new log
            $logData = [
                'id' => count($rekamMedisLog) + 1,
                'user_id' => auth()->user()->id,
                'time' => now()->format('Y-m-d H:i:s'),
                'title' => 'Update',
                'content' => [
                    'kode' => 'Update kode rekam medis dari ' . $rekamMedis->kode . ' menjadi ' . $request->kode,
                    // 'tanggal_unggah' => 'Tanggal diubah ' . now()->format('Y-m-d H:i:s'),
                    'dokumen' => $dokumen
                ]
            ];

            // push new log to json data
            $rekamMedisLog[] = $logData;

            $data = [
                'kode' => $request->kode,
                'user_id' => auth()->user()->id,
                'log' => json_encode($rekamMedisLog)
            ];

            $rekamMedis->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function history($id)
    {
        $rekamMedis = RekamMedis::find($id);
        $log = json_decode($rekamMedis->log, true);
        $data = [];
        foreach ($log as $log) {
            $content = $log['content'];
            $data[] = [
                'petugas' => User::find($log['user_id'])->nama,
                'title' => $log['title'],
                'tanggal' => date_format(date_create($log['time']), 'd-m-Y H:i:s'),
                'kode' => preg_replace('/\b(RM-\S+)\b/', '<strong>$1</strong>', $content['kode']),
                // 'kode' => ex plode('medis ', $content['kode'])[1],
                'dokumen' => $content['dokumen']
            ];
        }
        // dd($data);
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        try {
            $rekamMedis = RekamMedis::find($request->id);
            // dd($rekamMedis);
            $log = json_decode($rekamMedis->log, true);

            foreach ($log as $log) {
                $content = $log['content'];
                unlink($content['dokumen']);
            }

            $rekamMedis->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil terhapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function filter(Request $request)
    {
        if ($request->kategori == 'Semua') {
            $rekamMedis = RekamMedis::all();
        } else {
            $startTime = $request->input('tanggal_awal');
            $endTime = $request->input('tanggal_akhir');

            $data = RekamMedis::with('user')->get();

            // Filter records based on the 'time' attribute within the 'log' array
            $rekamMedis = $data->filter(function ($record) use ($startTime, $endTime) {
                $logs = json_decode($record->log, true);
                foreach ($logs as $log) {
                    if (isset($log['time']) && $log['time'] >= $startTime && $log['time'] <= $endTime) {
                        return true;
                    }
                }
                return false;
            });
        }
        // dd($rekamMedis);

        $view = [
            'data' => view('main.rekam-medis.filter.render', compact('rekamMedis'))->render(),
        ];
        // $data = [];
        // foreach ($rekamMedis as $rekamMedis) {
        //     foreach(json_decode($rekamMedis->log, true) as $rm) {
        //         $content = $rm['content'];
        //         $data[] = [
        //             'rm_id' => $rekamMedis->id,
        //             'kode' => $rekamMedis->kode,
        //             'tanggal' => date_format(date_create($rm['time']), 'd-m-Y'),
        //             'petugas' => User::find($rm['user_id'])->nama,
        //             'dokumen' => $content['dokumen']
        //         ];
        //     }
        // }

        return response()->json($view);
    }
}
