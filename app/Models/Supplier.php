<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
    ];

    // Relasi ke Barang (Supplier bisa menyuplai banyak Barang)
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
