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
        'kategori_id',
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
