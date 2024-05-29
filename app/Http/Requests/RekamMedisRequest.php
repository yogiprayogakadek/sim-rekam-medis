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
            'kode' => 'required|string'
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'dokumen' => 'required|mimes:pdf'
            ];
        } else {
            $rules += [
                'dokumen' => 'nullable|mimes:pdf'
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
        ];
    }

    public function attributes()
    {
        return [
            'kode' => 'Kode rekam medis',
            'dokumen' => 'Dokumen',
        ];
    }
}
