<?php

namespace Database\Seeders;

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
        // Mendapatkan pemesanan yang sudah dikonfirmasi
        $pemesanan = Pemesanan::where('status', 'confirmed')->first(); // Ambil pemesanan yang statusnya confirmed

        // Membuat penjualan berdasarkan pemesanan
        $penjualan = Penjualan::create([
            'pemesanan_id' => $pemesanan->id,
            'customer_id' => $pemesanan->customer->id,
            'total_harga' => $pemesanan->total_harga,
            'tanggal_jual' => Carbon::now(),
            'status_pembayaran' => 'paid',
        ]);
    }
}
