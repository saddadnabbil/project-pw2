<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

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
