<?php

// app/Http/Requests/CustomerUpdateRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
        return [
            'user_id' => 'required',
            'nama' => 'required|min:3',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'Kolom user wajib diisi!',
            'nama.required' => 'Kolom nama wajib diisi!',
            'nama.min' => 'Kolom nama minimal 3 karakter!',
            'email.required' => 'Kolom email wajib diisi!',
            'email.email' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'alamat.required' => 'Kolom alamat wajib diisi!',
            'telepon.required' => 'Kolom telepon wajib diisi!',
            'telepon.numeric' => 'Kolom telepon harus berupa angka!',
        ];
    }
}
