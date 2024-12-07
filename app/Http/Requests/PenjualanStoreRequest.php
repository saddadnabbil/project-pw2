<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'tanggal_jual' => 'required|date',
            'status_pembayaran' => 'required|in:paid,unpaid',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Customer is required.',
            'customer_id.exists' => 'Customer does not exist.',
            'barang_id.required' => 'Barang is required.',
            'barang_id.exists' => 'The selected barang does not exist.',
            'jumlah.required' => 'Jumlah is required.',
            'jumlah.integer' => 'Jumlah must be an integer.',
            'jumlah.min' => 'Jumlah must be at least 1.',
            'harga_satuan.required' => 'Harga Satuan is required.',
            'harga_satuan.numeric' => 'Harga Satuan must be a valid number.',
            'harga_satuan.min' => 'Harga Satuan cannot be negative.',
            'total_harga.required' => 'Total price is required.',
            'total_harga.numeric' => 'Total price must be a valid number.',
            'tanggal_jual.required' => 'Tanggal Pesan is required.',
            'tanggal_jual.date' => 'Tanggal Pesan must be a valid date.',
            'status_pembayaran.required' => 'Payment status is required.',
            'status_pembayaran.in' => 'Payment status must be one of: paid, unpaid.',
        ];
    }
}
