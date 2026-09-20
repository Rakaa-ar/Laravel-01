<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
    ];
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
