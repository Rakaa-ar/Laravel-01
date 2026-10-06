@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container">
        <h2>Tambah User</h2>

        <form action="/user/tambah" method="POST" id="formTambah">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                        User
                    </option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" id="btnSimpan">
                Simpan User
            </button>

            <a href="/user" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
    <script>
        document.getElementById('formTambah').addEventListener('submit', function() {
            const button = document.getElementById('btnSimpan');

            button.disabled = true;
            button.innerText = 'Menyimpan...';
        });
    </script>
@endsection

