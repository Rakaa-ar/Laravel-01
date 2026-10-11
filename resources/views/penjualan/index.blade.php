@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold mb-1">Penjualan</h3>
                <p class="text-muted mb-0">
                    Kelola transaksi penjualan barang
                </p>
            </div>

            <a href="/penjualan/tambah" class="btn btn-primary text-nowrap">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Penjualan
            </a>
        </div>

        {{-- Tabel Penjualan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th class="text-center">Aksi</th>
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
                                        {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d-m-Y') }}
                                    </td>

                                    <td class="fw-semibold">
                                        Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="/penjualan/detail/{{ $penjualan->id }}">
                                                        <i class="bi bi-eye me-2"></i>
                                                        Detail
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/penjualan/edit/{{ $penjualan->id }}">
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
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-receipt fs-3 d-block mb-2"></i>
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
