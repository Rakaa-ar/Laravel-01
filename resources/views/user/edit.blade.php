@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit User</h2>

        <form action="/user/update/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                    required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                        User
                    </option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Password Baru (opsional)
                </label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" id="btnUpdate">
                Update User
            </button>

            <a href="/user" class="btn btn-secondary">
                Kembali
            </a>
        </form>
        <script>
            document.querySelector('form').addEventListener('submit', function() {
                document.getElementById('btnUpdate').disabled = true;
                document.getElementById('btnUpdate').innerText = 'Menyimpan...';
            });
        </script>
    </div>
@endsection
