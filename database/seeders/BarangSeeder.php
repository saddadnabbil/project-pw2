<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        Barang::create([
            'nama' => 'Paracetamol',
            'kode' => 'PRC001',
            'stok' => 100,
            'harga' => 5000.00,
        ]);

        Barang::create([
            'nama' => 'Ibuprofen',
            'kode' => 'IBP001',
            'stok' => 200,
            'harga' => 10000.00,
        ]);
    }
}
