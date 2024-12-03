<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'kode',
        'stok',
        'harga',
        'supplier_id',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getHargaAttribute($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
