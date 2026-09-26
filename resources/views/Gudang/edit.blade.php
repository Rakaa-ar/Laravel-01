@extends('layouts.app')

@section('title', 'Edit Gudang')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Edit Gudang</h2>

        <form action="/gudang/edit/{{ $gudang->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Gudang</label>

                <input type="text" name="nama_gudang" class="form-control" value="{{ $gudang->nama_gudang }}"required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">
                    Alamat
                </label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $gudang->alamat }}</textarea>

                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="/gudang" class="btn btn-secondary">
                    Kembali
                </a>
            </form>

        </div>

@endsection
