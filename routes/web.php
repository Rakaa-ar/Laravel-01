<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return 'Sistem Inventori Gudang';
});

Route::get('/inventori', [BarangController::class, 'index']);

Route::get('/inventori/tambah', [BarangController::class, 'create']);

Route::post('/inventori/tambah',[BarangController::class, 'store']);

Route::get('/inventori/edit/{id}', [BarangController::class, 'edit']);

Route::post('/inventori/update/{id}', [BarangController::class, 'update']);

Route::delete('/inventori/delete/{id}', [BarangController::class, 'destroy']);  

////PEMBATAS CRUD//////

Route::get('/supplier', [SupplierController::class, 'index']);

Route::get('/supplier/tambah', [SupplierController::class, 'create']);

Route::post('/supplier/tambah', [SupplierController::class, 'store']);

Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit']);

Route::post('/supplier/update/{id}', [SupplierController::class, 'update']);

Route::delete('/supplier/delete/{id}', [SupplierController::class, 'destroy']);

