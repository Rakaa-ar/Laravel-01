<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan;

class Penjualan extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'tanggal_penjualan',
        'total',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_Id');
    }
}
