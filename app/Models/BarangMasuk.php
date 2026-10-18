<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelian;

class BarangMasuk extends Model
{
    protected $fillable = [
        'pembelian_id',
        'barang_id',
        'supplier_id',
        'jumlah',
        'tanggal_masuk',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo((Supplier::class));
    }
    
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    
}
