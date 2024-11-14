<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::create([
            'nama' => 'PT Supplier Sehat',
            'alamat' => 'Jalan Sehat No. 456',
            'telepon' => '08129876543',
        ]);
    }
}
