@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

    <div class="container mt-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="mb-4">
                    <h2 class="mb-1">Tambah Barang</h2>
                    <p class="text-muted mb-0">
                        Tambahkan barang baru ke dalam inventori
                    </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Data belum lengkap!</strong>

                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/inventori/tambah" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">
                            Nama Barang
                        </label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                            placeholder="Contoh: Laptop">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>

                        <select name="kategori_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">
                            Harga
                        </label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Rp 0">
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="form-label">
                            Stok
                        </label>
                        <input type="number" name="stok" id="stok" class="form-control" placeholder="Contoh: 10">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Barang
                    </button>

                    <a href="/inventori" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>

        </div>

        <script>
            const harga = document.getElementById('harga');

            harga.addEventListener('input', function() {
                let angka = this.value.replace(/\D/g, '');

                if (angka) {
                    this.value = 'Rp ' + Number(angka).toLocaleString('id-ID');
                } else {
                    this.value = '';
                }
            });

            harga.form.addEventListener('submit', function() {
                harga.value = harga.value.replace(/\D/g, '');
            });
        </script>

    </div>

@endsection
