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
            'pemesanan_id' => $this->pemesanan_id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->nama,
            'total_harga' => $this->total_harga,
            'status_pembayaran' => $this->status_pembayaran,
            'tanggal_jual' => $this->tanggal_jual,
        ];
    }
}
