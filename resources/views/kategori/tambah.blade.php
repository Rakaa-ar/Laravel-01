@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Tambah Kategori</h2>

    <form action="/kategori/tambah" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>

            <input
                type="text"
                name="nama_kategori"
                class="form-control"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="/kategori" class="btn btn-secondary">
            Kembali
        </a>
    </form>

</div>

@endsection