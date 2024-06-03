<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('main.dashboard.index');
    }

    public function dailyChart()
    {
        $date = Carbon::now()->format('Y-m-d');
        $total = 0;

        // Mengelompokkan berdasarkan jenis kelamin dan menghitung jumlahnya
        $records = RekamMedis::selectRaw('jenis_kelamin, COUNT(*) as count')
            ->whereDate('created_at', $date)
            ->groupBy('jenis_kelamin')
            ->get();

        // Menyimpan hasil dalam array dengan key jenis_kelamin
        $results = [
            ['label' => 'Laki-laki', 'value' => 0],
            ['label' => 'Perempuan', 'value' => 0],
        ];

        // Menambahkan hasil dari query ke dalam array
        foreach ($records as $record) {
            if ($record->jenis_kelamin == 0) {
                $results[1]['value'] = $record->count;
            } else {
                $results[0]['value'] = $record->count;
            }

            $total += $record->count;
        }

        return response()->json([
            'daily' => $results,
            'total' => $total
        ]);
    }

    public function filterChart(Request $request)
    {
        $startTime = $request->input('tanggal_awal');
        $endTime = $request->input('tanggal_akhir');
        $total = 0;

        // Mengelompokkan berdasarkan jenis kelamin dan menghitung jumlahnya
        $records = RekamMedis::selectRaw('jenis_kelamin, COUNT(*) as count')
            ->whereBetween('tanggal_dokumen', [$startTime, $endTime])
            ->groupBy('jenis_kelamin')
            ->get();

        // Menyimpan hasil dalam array dengan key jenis_kelamin
        $results = [
            ['label' => 'Laki-laki', 'value' => 0],
            ['label' => 'Perempuan', 'value' => 0],
        ];

        // Menambahkan hasil dari query ke dalam array
        foreach ($records as $record) {
            if ($record->jenis_kelamin == 0) {
                $results[1]['value'] = $record->count;
            } else {
                $results[0]['value'] = $record->count;
            }

            $total += $record->count;

        }

        return response()->json([
            'filter' => $results,
            'total' => $total
        ]);
    }
}
