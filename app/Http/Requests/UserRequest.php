<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
            'username' => 'required|string',
            'nama' => 'required|string|max:50|min:3'
        ];

        if (Request::instance()->has('id')) {
            $rules += [
                'status' => 'required|numeric'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Nama pengguna',
            'nama' => 'Nama lengkap',
            'Status' => 'status',
        ];
    }
}
