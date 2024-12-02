<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'status',
        'tanggal_pesan',
    ];

    // Relasi ke Customer (Many-to-One)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke Barang (Many-to-One)
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
