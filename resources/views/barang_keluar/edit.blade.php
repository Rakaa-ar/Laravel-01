@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Edit Barang Keluar</h2>

        <form action="/barang-keluar/edit/{{ $barangKeluar->id }}" method="POST" id="formEdit">
            @csrf

            <div class="mb-3">
                <label class="form-label">Barang</label>

                <select name="barang_id" class="form-select">

                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $barangKeluar->barang_id == $barang->id ? 'selected' : '' }}>

                            {{ $barang->nama_barang }}

                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Supplier</label>

                <select name="gudang_id" class="form-select">

                    @foreach ($gudang as $item)
                        <option value="{{ $item->id }}"
                            {{ $barangKeluar->gudang_id == $item->id ? 'selected' : '' }}>

                            {{ $item->nama_gudang }}

                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>

                <input type="number" name="jumlah" class="form-control" value="{{ $barangKeluar->jumlah }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>

                <input type="date" name="tanggal_keluar" class="form-control" value="{{ $barangKeluar->tanggal_keluar }}">
            </div>

            <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan Perubahan
            </button>

            <a href="/barang-keluar" class="btn btn-secondary">
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
