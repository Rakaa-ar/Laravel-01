@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h2>Edit Barang</h2>

        <form action="/inventori/update/{{ $barang->id }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
            </div>

            <div class="class mb-3">
                <label class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" value="{{ $barang->harga }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}">
            </div>

            <button type="submit" class="btn btn-primary">
                Update Barang
            </button>

            <a href="/inventori" class="btn btn-secondary">
                Kembali
            </a>

        </form>
    </div>
@endsection
