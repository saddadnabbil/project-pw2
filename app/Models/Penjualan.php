<?php

namespace App\Models;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pemesanan_id',
        'customer_id',
        'total_harga',
        'tanggal_jual',
        'status_pembayaran',
    ];

    // Relasi ke Pemesanan (One-to-One)
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    // Relasi ke Customer (Many-to-One)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getTotalHargaAttribute($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
