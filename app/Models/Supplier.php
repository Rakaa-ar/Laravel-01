<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;

class Supplier extends Model
{
    protected $fillable = [
        'nama_supplier',
        'nama_penanggung_jawab',
        'no_telepon',
        'alamat',
    ];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
