<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemesananUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id', // Ensure customer exists
            'barang_id' => 'required|exists:barangs,id', // Ensure barang exists
            'jumlah' => 'required|integer|min:1', // Ensure jumlah is a positive integer
            'harga_satuan' => 'required|numeric|min:0', // Ensure harga_satuan is a valid number
            'status' => 'required|in:pending,confirmed,shipped,delivered', // Ensure status is one of the allowed values
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
            'customer_id.required' => 'Customer is required.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'barang_id.required' => 'Barang is required.',
            'barang_id.exists' => 'The selected barang does not exist.',
            'jumlah.required' => 'Jumlah is required.',
            'jumlah.integer' => 'Jumlah must be an integer.',
            'jumlah.min' => 'Jumlah must be at least 1.',
            'harga_satuan.required' => 'Harga Satuan is required.',
            'harga_satuan.numeric' => 'Harga Satuan must be a valid number.',
            'harga_satuan.min' => 'Harga Satuan cannot be negative.',
            'status.required' => 'Status is required.',
            'status.in' => 'The status must be one of the following: pending, confirmed, shipped, or delivered.',
        ];
    }
}
