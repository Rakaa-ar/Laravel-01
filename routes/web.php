<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return 'Sistem Inventori Gudang';
});

Route::get('/inventori', [BarangController::class, 'index']);

Route::get('/inventori/barang', [BarangController::class, 'barang']);

Route::get('/inventori/tambah', [BarangController::class, 'create']);

Route::post('/inventori/tambah',[BarangController::class, 'store']);

