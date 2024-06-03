<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function defaultPassword()
    {
        return '12345678';
    }

    public function index()
    {
        return view('main.user.index');
    }

    public function render()
    {
        $users = User::all();

        $view = [
            'data' => view('main.user.render', compact('users'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.user.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(UserRequest $request)
    {
        try {
            $user = [
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($this->defaultPassword()),
                'level' => 'staff',
                'status' => true
            ];

            User::create($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $view = [
            'data' => view('main.user.edit', compact('user'))->render(),
        ];

        return response()->json($view);
    }

    public function update(UserRequest $request)
    {
        try {
            $user = User::find($request->id);

            $data = [
                'username' => $request->username,
                'nama' => $request->nama,
                'status' => $request->status
            ];

            $user->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->id);

            $user->delete();

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

    // forgot password
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            // dd($request->all());
            $user = User::where('id', $request->user_id)->first();
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    // change password
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if ($request->current_password != '') {
                if (!password_verify($request->current_password, $user->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Password lama tidak sesuai',
                        'title' => 'Gagal'
                    ]);
                }

                // Update password baru jika sudah benar
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
