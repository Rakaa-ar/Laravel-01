@extends('layouts.app')

@section('title', 'Tambah Satuan')

@section('content') 

<div class="container mt-4">

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h2 class="mb-1">Tambah Satuan</h2>
            <p class="text-muted mb-4">
                Tambahkan satuan barang baru
            </p>

            <form action="/satuan/tambah" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Satuan</label>

                    <input
                        type="text"
                        name="nama_satuan"
                        class="form-control"
                        placeholder="Contoh: Pcs"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="/satuan" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection