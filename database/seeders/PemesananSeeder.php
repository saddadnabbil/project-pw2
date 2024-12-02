<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Pemesanan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan customer pertama
        $customer = Customer::first(); // Ambil customer pertama (bisa diganti dengan ID tertentu)

        // Mendapatkan barang pertama
        $barang = Barang::first(); // Ambil barang pertama

        // Membuat pemesanan pertama
        $pemesanan = Pemesanan::create([
            'customer_id' => $customer->id,
            'barang_id' => $barang->id,
            'jumlah' => 2,
            'harga_satuan' => $barang->harga,
            'total_harga' => $barang->harga * 2,
            'status' => 'pending',
            'tanggal_pesan' => Carbon::now(),
        ]);

        // Menambahkan pemesanan kedua
        $barang2 = Barang::skip(1)->first(); // Ambil barang kedua

        $pemesanan2 = Pemesanan::create([
            'customer_id' => $customer->id,
            'barang_id' => $barang2->id,
            'jumlah' => 1,
            'harga_satuan' => $barang2->harga,
            'total_harga' => $barang2->harga * 1,
            'status' => 'confirmed',
            'tanggal_pesan' => Carbon::now()->addDay(),
        ]);
    }
}
