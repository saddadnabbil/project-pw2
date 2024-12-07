<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'barang_id',
        'customer_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_jual',
        'status_pembayaran',
    ];

    // Relasi ke Pemesanan (One-to-One)
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Relasi ke Customer (Many-to-One)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
