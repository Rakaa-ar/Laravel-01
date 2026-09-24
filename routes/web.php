<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;


Route::get('/', function () {

    return 'Sistem Inventori Gudang';
});

Route::get('/inventori', [BarangController::class, 'index']);

Route::get('/inventori/tambah', [BarangController::class, 'create']);

Route::post('/inventori/tambah',[BarangController::class, 'store']);

Route::get('/inventori/edit/{id}', [BarangController::class, 'edit']);

Route::post('/inventori/update/{id}', [BarangController::class, 'update']);

Route::delete('/inventori/delete/{id}', [BarangController::class, 'destroy']);  

////PEMBATAS SUPPLIERS CRUD\\\\

Route::get('/supplier', [SupplierController::class, 'index']);

Route::get('/supplier/tambah', [SupplierController::class, 'create']);

Route::post('/supplier/tambah', [SupplierController::class, 'store']);

Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit']);

Route::post('/supplier/update/{id}', [SupplierController::class, 'update']);

Route::delete('/supplier/delete/{id}', [SupplierController::class, 'destroy']);

////PEMBATAS BARANG MASUK\\\\\

Route::get('/barang-masuk', [BarangMasukController::class, 'index']);

Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create']);

Route::post('/barang-masuk/tambah', [BarangMasukController::class, 'store']);

Route::get('/barang-masuk/edit/{id}', [BarangMasukController::class, 'edit']);

Route::post('/barang-masuk/edit/{id}', [BarangMasukController::class, 'update']);

Route::delete('/barang-masuk/delete/{id}', [BarangMasukController::class, 'destroy']);

////PEMBATAS KATEGORI\\\

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/kategori/tambah', [KategoriController::class, 'create']);

Route::post('/kategori/tambah', [KategoriController::class, 'store']);

Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']); 

Route::put('/kategori/edit/{id}', [KategoriController::class, 'update']);

Route::delete('/kategori/hapus/{id}', [KategoriController::class, 'destroy']);

//// PEMBATAS \\\\\\

Route::get('/satuan', [SatuanController::class, 'index']);

Route::get('/satuan/tambah', [SatuanController::class, 'create']);

Route::post('/satuan/tambah', [SatuanController::class, 'store']);

Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit']);

Route::put('/satuan/edit/{id}', [SatuanController::class, 'update']);