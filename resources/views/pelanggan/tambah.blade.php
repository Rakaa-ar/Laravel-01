@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="container mt-4">

        {{-- Breadcrumb --}}
        <div class="mb-4">
            <span class="text-muted">Pelanggan</span>
            <span class="text-muted"> / </span>
            <span>Tambah Pelanggan</span>
        </div>

        {{-- Header --}}
        <div class="mb-4">
            <h2 class="mb-1">Tambah Pelanggan</h2>
            <p class="text-muted mb-0">
                Tambahkan data pelanggan baru
            </p>
        </div>

        {{-- Form --}}
        <div class="card">
            <div class="card-body">

                <form action="/pelanggan/tambah" method="POST" id="formTambah">
                    @csrf

                    {{-- Nama Pelanggan --}}
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">
                            Nama Pelanggan
                        </label>

                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control"
                            placeholder="Masukkan nama pelanggan" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan email">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">
                            Nomor Telepon
                        </label>

                        <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                            placeholder="Masukkan nomor telepon">
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label for="alamat" class="form-label">
                            Alamat
                        </label>

                        <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan alamat pelanggan"></textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btnSimpan">
                            Simpan Pelanggan
                        </button>

                        <a href="/pelanggan" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>

    </div>
    <script>
        document.getElementById('formTambah').addEventListener('submit', function() {
            const button = document.getElementById('btnSimpan');

            button.disabled = true;
            button.innerText = 'Menyimpan...';
        });
    </script>
@endsection
