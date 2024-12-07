<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->nama,
            'barang_id' => $this->barang_id,
            'barang_name' => $this->barang->nama,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'total_harga' => $this->total_harga,
            'status_pembayaran' => $this->status_pembayaran,
            'tanggal_jual' => $this->tanggal_jual,
        ];
    }
}
