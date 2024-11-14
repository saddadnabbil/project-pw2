<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'stok',
        'harga',
    ];

    // Relasi ke Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
