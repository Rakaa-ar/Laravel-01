@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Tambah Barang Masuk</h2>

        <form action="/barang-masuk/tambah" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Barang</label>

                <select name="barang_id" class="form-select">
                    <option value="">-- Pilih Barang --</option>

                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">
                            {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Supplier</label>

                <select name="supplier_id" class="form-select">
                    <option value="">-- Pilih Supplier --</option>

                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan
            </button>

            <a href="/barang-masuk" class="btn btn-secondary">
                Kembali
            </a>

        </form>
        <script>
            document.querySelector('form').addEventListener('submit', function() {
                document.getElementById('btnSimpan').disabled = true;
                document.getElementById('btnSimpan').innerText = 'Menyimpan...';
            });
        </script>

    </div>

@endsection
