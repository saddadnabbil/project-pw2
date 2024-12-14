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

    // Event lifecycle untuk mengurangi stok
    protected static function booted()
    {
        // Saat membuat penjualan
        static::creating(function ($penjualan) {
            $barang = Barang::find($penjualan->barang_id);

            if ($barang && $barang->stok >= $penjualan->jumlah) {
                $barang->stok -= $penjualan->jumlah;
                $barang->save();
            } else {
                throw new \Exception('Stok barang tidak mencukupi.');
            }
        });

        // Saat mengupdate penjualan
        static::updating(function ($penjualan) {
            $original = $penjualan->getOriginal();
            $barang = Barang::find($penjualan->barang_id);

            if ($barang) {
                // Kembalikan stok barang sebelumnya
                $barang->stok += $original['jumlah'];

                // Kurangi stok barang dengan jumlah baru
                if ($barang->stok >= $penjualan->jumlah) {
                    $barang->stok -= $penjualan->jumlah;
                    $barang->save();
                } else {
                    throw new \Exception('Stok barang tidak mencukupi.');
                }
            }
        });

        // Saat menghapus penjualan
        static::deleting(function ($penjualan) {
            $barang = Barang::find($penjualan->barang_id);

            if ($barang) {
                $barang->stok += $penjualan->jumlah;
                $barang->save();
            }
        });
    }
}
