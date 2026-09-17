@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<div class="container mt-4">

  <h1 class="mb-4">Tambah Barang</h1>

  <form action="/inventori/tambah" method="POST">
    @csrf
    
    <div class="mb-3">
      <label for="nama_barang" class="form-label">
        Nama Barang
      </label>

      <input
        type="text"
        name="nama_barang"
        id="nama_barang"
        class="form-control">
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">
        Harga
      </label>

      <input
        type="number"
        name="harga"
        id="harga"
        class="form-control">
    </div>

    <div class="mb-3">
      <label for="stok" class="form-label">
        Stok
      </label>

      <input
        type="number"
        name="stok"
        id="stok"
        class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
      Simpan
    </button>

    <a href="/inventori" class="btn btn-secondary">
      Kembali
    </a>

  </form>

</div>

@endsection