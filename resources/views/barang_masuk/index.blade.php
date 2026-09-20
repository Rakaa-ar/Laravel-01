@extends('layouts.app')

@section('title', 'Barang Masuk')

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
                        <h2 class="mb-1">Data Barang Masuk</h2>
                        <p class="text-muted mb-0">
                            Kelola data barang masuk gudang
                        </p>
                    </div>

                    <a href="/barang-masuk/tambah" class="btn btn-primary">
                        + Tambah Barang Masuk
                    </a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Supplier</th>
                                <th>Jumlah</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($barangMasuks as $barangMasuk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $barangMasuk->barang->nama_barang }}
                                    </td>

                                    <td>
                                        {{ $barangMasuk->supplier->nama_supplier }}
                                    </td>

                                    <td>
                                        {{ $barangMasuk->jumlah }}
                                    </td>

                                    <td>
                                        {{ $barangMasuk->tanggal_masuk }}
                                    </td>

                                    <td>
                                        <a href="/barang-masuk/edit/{{ $barangMasuk->id }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="/barang-masuk/delete/{{ $barangMasuk->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus barang masuk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data barang masuk.
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
