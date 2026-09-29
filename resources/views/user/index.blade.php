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

                        <div>
                            <button class="btn btn-light">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
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
