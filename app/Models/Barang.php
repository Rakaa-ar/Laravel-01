<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Satuan;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'kategori_id',
        'satuan_id',
    ];
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
