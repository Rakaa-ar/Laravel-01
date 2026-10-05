<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\UserController;
use PSpell\Config;

Route::middleware('auth')->group(function () {
//semua route wajib login\\
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

Route::delete('/satuan/hapus/{id}', [SatuanController::class, 'destroy']);

/////PEMBATAS\\\\\\

Route::get('gudang', [GudangController::class, 'index' ]);

Route::get('/gudang/tambah', [GudangController::class, 'create']);

Route::post('/gudang/tambah', [GudangController::class, 'store']);

Route::get('/gudang/edit/{id}', [GudangController::class, 'edit']);

Route::put('/gudang/edit/{id}', [GudangController::class, 'update']);

Route::delete('/gudang/delete/{id}', [GudangController::class, 'destroy']);

////PEMBATAS\\\\\

Route::get('/barang-keluar', [BarangKeluarController::class, 'index']);

Route::get('/barang-keluar/tambah', [BarangKeluarController::class, 'create']);

Route::post('/barang-keluar/tambah', [BarangKeluarController::class, 'store']);

Route::get('/barang-keluar/edit/{id}', [BarangKeluarController::class, 'edit']); 

Route::put('/barang-keluar/update/{id}', [BarangKeluarController::class, 'update']);

Route::delete('/barang-keluar/delete/{id}', [BarangKeluarController::class, 'destroy']); 


////PEMBATAS\\\\\\\

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'create']);
Route::post('/user/tambah', [UserController::class, 'store']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
});

//

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', function () {
    return view('auth.register');
});    

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verify-otp', function(){
    return view('auth.verify-otp');
});

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
//
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword']);
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetOtp']);
Route::get('/reset-password/verify', [AuthController::class, 'showResetPasswordOtp']);
Route::post('/reset-password/verify', [AuthController::class, 'verifyResetPasswordOtp']);

Route::get('/reset-password/new', [AuthController::class, 'showNewPasswordForm']);
Route::post('/reset-password/new', [AuthController::class, 'ResetPassword']);

//









