<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\gudang;

class Gudang extends Model
{
    protected $table = 'gudang';

    protected $fillable = [
        'nama_gudang',
        'alamat',
    ];
}