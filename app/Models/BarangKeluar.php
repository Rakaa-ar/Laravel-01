<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Gudang;

class BarangKeluar extends Model
{
    protected $fillable = [
        'barang_id',
        'gudang_id',
        'jumlah',
        'tanggal_keluar',

    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
