@extends('layouts.app')

@section('title', 'User Management')

@section('content')

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>

            <script>
                setTimeout(function() {
                    const alert = document.querySelector('.alert');
                    if (alert) {
                        alert.remove();
                    }
                }, 3000);
            </script>
        @endif


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">User Management</h2>
                <p class="text-muted mb-0">
                    Kelola pengguna sistem
                </p>
            </div>

            <a href="/user/tambah" class="btn btn-primary">
                <i class="bi bi-person-plus"></i>
                Tambah User
            </a>
        </div>

        @forelse ($users as $user)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div class="me-3">
                                <i class="bi bi-person-circle fs-1"></i>
                            </div>

                            <div>
                                <h5 class="mb-1">
                                    {{ $user->name }}
                                </h5>

                                <p class="text-muted mb-2">
                                    {{ $user->email }}
                                </p>

                                @if ($user->role == 'admin')
                                    <span class="badge bg-danger">
                                        ADMIN
                                    </span>
                                @else
                                    <span class="badge bg-primary">
                                        USER
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="dropdown">
                            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="/user/edit/{{ $user->id }}">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Edit
                                    </a>
                                </li>

                                <li>
                                    <form action="/user/delete/{{ $user->id }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash me-2"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>

        @empty

            <div class="text-center py-5">
                <i class="bi bi-people fs-1 text-muted"></i>

                <h5 class="mt-3">
                    Belum ada user
                </h5>

                <p class="text-muted">
                    Silakan tambahkan user baru.
                </p>
            </div>
        @endforelse

    </div>

@endsection
