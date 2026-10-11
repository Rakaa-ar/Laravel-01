<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'penjualan_Id',
        'barang_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_Id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
