<?php

// app/Http/Resources/PemesananResource.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PemesananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
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
            'status' => $this->status,
            'tanggal_pesan' => $this->tanggal_pesan,
        ];
    }
}
