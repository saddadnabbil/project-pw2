<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        Pemesanan::create([
            'customer_id' => 1,
            'barang_id' => 1,
            'jumlah' => 2,
            'tanggal_pemesanan' => now(),
        ]);
    }
}
