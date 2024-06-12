<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'password' => 'required|same:re_password|min:8',
            're_password' => 'required|same:password|min:8',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'same' => ':attribute tidak sama',
            'min' => ':attribute minimal :min karakter',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Kata sandi baru',
            're_password' => 'Konfirmasi kata sandi',
        ];
    }
}
