<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RekamMedisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'kode' => 'required|string',
            'tanggal_dokumen' => 'required|date',
            'nama_pasien' => 'required|string',
            // 'nik' => 'required|numeric|digits:16',
            'jenis_kelamin' => 'required|in:0,1'
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'dokumen' => 'required|mimes:pdf,jpeg,jpg,png,gif',
            ];
        } else {
            $rules += [
                'dokumen' => 'nullable|mimes:pdf,jpeg,jpg,png,gif',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'mimes' => ':attribute harus berupa file berformat PDF.',
            'unique' => ':attribute sudah ada',
            'numeric' => ':attribute harus berupa angka',
            'digits' => ':attribute harus berupa angka dan panjangnya :digits digit',
            'in' => ':attribute tidak valid',
            'date' => ':attribute tidak valid'
        ];
    }

    public function attributes()
    {
        return [
            'kode' => 'Kode rekam medis',
            'dokumen' => 'Dokumen',
            'nama_pasien' => 'Nama pasien',
            // 'nik' => 'NIK',
            'jenis_kelamin' => 'Jenis kelamin',
            'tanggal_dokumen' => 'Tanggal dokumen'
        ];
    }
}
