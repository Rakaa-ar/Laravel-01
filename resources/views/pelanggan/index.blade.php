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
                                        <span class="text-muted">-</span>
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
                </div>

            </div>
        </div>

    </div>

@endsection
