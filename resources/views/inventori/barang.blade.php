@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Barang</h1>
        <a href="/inventori/tambah" class="btn btn-primary">
            Tambah Barang
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($barangs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>Rp{{ number_format($item->harga, 0, ',','.') }}</td>
                <td>{{ $item->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection