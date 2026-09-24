<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Satuan extends Model
{
    protected $fillable = [
        'nama_satuan',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
