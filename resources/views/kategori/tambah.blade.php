@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Tambah Kategori</h2>

        <form action="/kategori/tambah" method="POST" id="formTambah">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>

                <input type="text" name="nama_kategori" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan
            </button>

            <a href="/kategori" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
    <script>
        document.getElementById('formTambah').addEventListener('submit', function() {
            const button = document.getElementById('btnSimpan');

            button.disabled = true;
            button.innerText = 'Menyimpan...';
        });
    </script>
@endsection
