@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')

    <div class="container mt-4">
        <div class="card border-0 shadow-sm">
            <div class=" card-body p-4">

                <h2 class="mb-1">Edit Pelanggan</h2>
                <p class="text-muted mb-4">
                    Perbarui Data Pelanggan
                </p>

                <form action="/pelanggan/update/{{ $pelanggan->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Pelanggan
                        </label>

                        <input type="text" name="nama_pelanggan" class="form-control"
                            value="{{ $pelanggan->nama_pelanggan }}">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email" name="email" class="form-control" value="{{ $pelanggan->email }}">

                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nomer Telepon
                        </label>

                        <input type="text" name="no_telepon" class="form-control" value="{{ $pelanggan->no_telepon }}">

                    </div>

                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="4">{{ $pelanggan->alamat }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btnUpdate">
                        Update.
                    </button>


                    <a href="/pelanggan" class="btn btn-secondary">
                        Kembali</a>
                </form>

            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.querySelector('form');
            const button = document.getElementById('btnUpdate');

            form.addEventListener('submit', function() {
                button.disabled = true;
                button.innerText = 'Menyimpan...';
            });

        });
    </script>
@endsection
