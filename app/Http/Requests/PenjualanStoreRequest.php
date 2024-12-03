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
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'customer_id' => 'required|exists:customers,id',
            'total_harga' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:paid,unpaid',
        ];
    }

    public function messages()
    {
        return [
            'pemesanan_id.required' => 'Pemesanan ID is required.',
            'pemesanan_id.exists' => 'Pemesanan ID does not exist.',
            'customer_id.required' => 'Customer is required.',
            'customer_id.exists' => 'Customer does not exist.',
            'total_harga.required' => 'Total price is required.',
            'total_harga.numeric' => 'Total price must be a valid number.',
            'status_pembayaran.required' => 'Payment status is required.',
            'status_pembayaran.in' => 'Payment status must be one of: paid, unpaid.',
        ];
    }
}
