<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return 'Sistem Inventori Gudang';
});

Route::get('/inventori', [BarangController::class, 'index']);

Route::get('/inventori/tambah', [BarangController::class, 'create']);

Route::post('/inventori/tambah',[BarangController::class, 'store']);

Route::get('/inventori/edit/{id}', [BarangController::class, 'edit']);

Route::post('/inventori/update/{id}', [BarangController::class, 'update']);

