@extends('layouts.app')

@section('title', 'Tambah Gudang')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Tambah Data Gudang</h2>

        <form action="/gudang/tambah" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Gudang</label>

                <input type="text" name="nama_gudang" class="form-control">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">
                    Alamat
                </label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat gudang"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="/gudang" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>

@endsection
