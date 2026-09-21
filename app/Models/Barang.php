<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;
use App\Models\Kategori;

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
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
