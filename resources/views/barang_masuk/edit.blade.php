@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Edit Barang Masuk</h2>

        <form action="/barang-masuk/edit/{{ $barangMasuk->id }}" method="POST" id="formEdit">
            @csrf

            <div class="mb-3">
                <label class="form-label">Barang</label>

                <select name="barang_id" class="form-select">

                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $barangMasuk->barang_id == $barang->id ? 'selected' : '' }}>

                            {{ $barang->nama_barang }}

                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Supplier</label>

                <select name="supplier_id" class="form-select">

                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ $barangMasuk->supplier_id == $supplier->id ? 'selected' : '' }}>

                            {{ $supplier->nama_supplier }}

                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>

                <input type="number" name="jumlah" class="form-control" value="{{ $barangMasuk->jumlah }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>

                <input type="date" name="tanggal_masuk" class="form-control" value="{{ $barangMasuk->tanggal_masuk }}">
            </div>

            <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan Perubahan
            </button>

            <a href="/barang-masuk" class="btn btn-secondary">
                Kembali
            </a>

            </form>
            <script>
                document.getElementById('formEdit').addEventListener('submit', function() {
                    const button = document.getElementById('btnSimpan');

                    button.disabled = true;
                    button.innerText = 'Menyimpan...';
                });
            </script>

    </div>

@endsection
