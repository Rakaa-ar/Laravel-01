@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Edit Kategori</h2>

        <form action="/kategori/edit/{{ $kategori->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>

                <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}">
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="/kategori" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>

@endsection
