@extends('layouts.app')

@section('title', 'Barang Keluar')

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

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">Data Barang Keluar</h2>
                        <p class="text-muted mb-0">
                            Kelola data barang Keluar gudang
                        </p>
                    </div>

                    <a href="/barang-keluar/tambah" class="btn btn-primary">
                        + Tambah Barang Keluar
                    </a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Gudang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Keluar</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($barangKeluars as $barangKeluar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $barangKeluar->barang->nama_barang }}
                                    </td>

                                    <td>
                                        {{ $barangKeluar->gudang->nama_gudang }}
                                    </td>

                                    <td>
                                        {{ $barangKeluar->jumlah }}
                                    </td>

                                    <td>
                                        {{ $barangKeluar->tanggal_keluar }}
                                    </td>

                                    <td>
                                        <a href="/barang-keluar/edit/{{ $barangKeluar->id }}"
                                            class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="/barang-keluar/delete/{{ $barangKeluar->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus barang keluar ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data barang keluar.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $barangKeluars->links() }}
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
