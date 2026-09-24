@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

    <div class="container mt-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="mb-4">
                    <h2 class="mb-1">Edit Barang</h2>
                    <p class="text-muted mb-0">
                        Perbarui data barang inventori
                    </p>
                </div>

                <form action="/inventori/update/{{ $barang->id }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">
                            Nama Barang
                        </label>

                        <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                            value="{{ $barang->nama_barang }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>

                        <select name="kategori_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Satuan</label>

                        <select name="satuan_id" class="form-select">
                            <option value="">-- Pilih Satuan --</option>

                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}"
                                    {{ $barang->satuan_id == $satuan->id ? 'selected' : '' }}>
                                    {{ $satuan->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">
                            Harga
                        </label>

                        <input type="text" name="harga" id="harga" class="form-control"
                            value="{{ $barang->harga }}">
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="form-label">
                            Stok
                        </label>

                        <input type="number" name="stok" id="stok" class="form-control"
                            value="{{ $barang->stok }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Barang
                    </button>

                    <a href="/inventori" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>

        </div>

    </div>

    <script>
        const harga = document.getElementById('harga');

        function formatRupiah(angka) {
            angka = angka.toString().replace(/\D/g, '');

            if (angka) {
                return 'Rp ' + Number(angka).toLocaleString('id-ID');
            }

            return '';
        }

        harga.value = formatRupiah(harga.value);

        harga.addEventListener('input', function() {
            this.value = formatRupiah(this.value);
        });

        harga.form.addEventListener('submit', function() {
            harga.value = harga.value.replace(/\D/g, '');
        });
    </script>

@endsection
