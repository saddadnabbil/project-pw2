<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Pemesanan;
use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = Barang::first();
        $customer = Customer::first();

        // Membuat penjualan berdasarkan pemesanan
        $penjualan = Penjualan::create([
            'barang_id' => $barang->id,
            'customer_id' => $customer->id,
            'jumlah' => 3,
            'harga_satuan' => $barang->harga,
            'total_harga' => $barang->harga * 3,
            'tanggal_jual' => Carbon::now(),
            'status_pembayaran' => 'paid',
        ]);
    }
}
