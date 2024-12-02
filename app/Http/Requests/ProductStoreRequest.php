<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'nama' => 'required|min:3',
            'kode' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'supplier_id' => 'required',
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
            'nama.required' => 'Kolom nama wajib diisi!',
            'nama.min' => 'Kolom nama minimal 3 karakter!',
            'kode.required' => 'Kolom kode wajib diisi!',
            'stok.required' => 'Kolom stok wajib diisi!',
            'harga.required' => 'Kolom harga wajib diisi!',
            'supplier_id.required' => 'Kolom supplier wajib diisi!',
        ];
    }
}
