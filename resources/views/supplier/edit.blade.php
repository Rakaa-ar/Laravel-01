@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')

    <div class="container mt-4">

        <h1 class="mb-4">Edit Data Supplier</h1>

        <form action="/supplier/update/{{ $supplier->id }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Supplier</label>
                <input type="text" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Penanggung Jawab</label>
                <input type="text" name="nama_penanggung_jawab" class="form-control"
                    value="{{ $supplier->nama_penanggung_jawab }}">
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="{{ $supplier->no_telepon }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="4">{{ $supplier->alamat }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="/supplier" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

@endsection
