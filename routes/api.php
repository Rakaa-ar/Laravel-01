<?php

use App\Models\Barang;
use App\Models\Pembelian; 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/inventori', function () {
    $barang = Barang::all();
    return response()->json([
        'status' => 'success',
        'data' => $barang
    ]);
});

Route::get('/pembelian', function () {
  $pembelian = Pembelian::all();
  return response()->json([
    'status' => 'success',
    'data' => $pembelian
  ]);
});

Route::post('/inventori', function (Request $request) {
  
  $barangBaru = new Barang();

  $barangBaru->nama_barang = $request->nama_barang;
  $barangBaru->harga = $request->harga;
  $barangBaru->stok = $request->stok;
  $barangBaru->kategori_id = $request->kategori_id;
  $barangBaru->satuan_id = $request->satuan_id;

  $barangBaru->save();

  return response()->json([
    'status' => 'success',
    'message' => 'Barang Berhasil di tambahkan',
    'data' => $barangBaru
  ]);
});