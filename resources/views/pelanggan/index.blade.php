@extends('layouts.app')

@section('title', 'Pelanggan')

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
                <h2 class="mb-1">Pelanggan</h2>
                <p class="text-muted mb-0">Kelola data pelanggan</p>
            </div>

            <a href="/pelanggan/tambah" class="btn btn-primary">
                + Tambah Pelanggan
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $pelanggan->email ?? '-' }}</td>
                                    <td>{{ $pelanggan->no_telepon ?? '-' }}</td>
                                    <td>{{ $pelanggan->alamat ?? '-' }}</td>
                                    <td>
                                        {{-- Nanti kita isi Edit & Hapus --}}
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>

                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a class="dropdown-item" href="/pelanggan/edit/{{ $pelanggan->id }}">
                                                        <i class="bi bi-pencil me-2"></i>
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <form action="/pelanggan/delete/{{ $pelanggan->id }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
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

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data pelanggan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $pelanggans->onEachSide(2)->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
