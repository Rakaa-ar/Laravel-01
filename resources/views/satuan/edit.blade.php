@extends('layouts.app')

@section('title', 'Edit Satuan')

@section('content')

    <div class="container mt-4">
        <div class="card border-0 shadow-sm">
            <div class=" card-body p-4">

                <h2 class="mb-1">Edit Satuan</h2>
                <p class="text-muted mb-4">
                    Perbarui Data Satuan
                </p>

                <form action="/satuan/edit/{{ $satuan->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Satuan
                        </label>

                        <input type="text" name="nama_satuan" class="form-control"
                            value="{{ $satuan->nama_satuan }}">

                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update.
                    </button>


                    <a href="/satuan" class="btn btn-secondary">
                        Kembali</a>
                </form>

            </div>
          </div>

        </div>
    @endsection
