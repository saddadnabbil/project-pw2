<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'barang_id',
        'jumlah',
        'tanggal_pemesanan',
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
