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

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
