@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')

    <div class="container mt-4">

        <h1 class="mb-4">Tambah Supplier</h1>

        <form action="/supplier/tambah" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Supplier</label>
                <input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan nama supplier">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Penanggung Jawab</label>
                <input type="text" name="nama_penanggung_jawab" class="form-control"
                    placeholder="Masukkan nama penanggung jawab">
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telepon" class="form-control" placeholder="Masukkan nomor telepon">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat supplier"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Supplier
            </button>

            <a href="/supplier" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

@endsection
