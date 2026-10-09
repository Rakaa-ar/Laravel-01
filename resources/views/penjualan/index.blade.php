@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Penjualan</h3>
                <p class="text-muted mb-0">
                    Kelola transaksi penjualan barang
                </p>
            </div>

            <a href="/penjualan/tambah" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Penjualan
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($penjualans as $penjualan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $penjualan->tanggal_penjualan }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi bi-eye me-2"></i>
                                                        Detail
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/penjualan/edit/{{ $penjualan->id }}" class="dropdown-item">
                                                        <i class="bi bi-pencil me-2"></i>
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <form action="/penjualan/delete/{{ $penjualan->id }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus penjualan ini?')">
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
                                    <td colspan="5" class="text-center">
                                        Belum ada data penjualan.
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
