<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'alamat' => 'required',
            'telepon' => 'required',
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
            'name.required' => 'Kolom nama wajib diisi!',
            'name.min' => 'Kolom nama minimal 3 karakter!',
            'name.max' => 'Kolom nama maksimal 191 karakter!',
            'alamat.required' => 'Kolom alamat wajib diisi!',
            'telepon.required' => 'Kolom telepon wajib diisi!',
        ];
    }
}
