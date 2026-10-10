@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="text-muted small mb-2">
                Penjualan / Detail Penjualan
            </div>
            <h3 class="fw-bold mb-1">Detail Penjualan</h3>
            <p class="text-muted mb-0">
                Informasi lengkap transaksi dan barang yang terjual.
            </p>
        </div>

        <a href="/penjualan" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- Informasi Transaksi --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-4">

                <div class="col-md-3">
                    <div class="text-muted small mb-2">ID Transaksi</div>
                    <h5 class="fw-bold mb-0">
                        #{{ $penjualan->id }}
                    </h5>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small mb-2">Pelanggan</div>
                    <h6 class="fw-semibold mb-0">
                        {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}
                    </h6>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small mb-2">Tanggal Penjualan</div>
                    <h6 class="fw-semibold mb-0">
                        {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d M Y') }}
                    </h6>
                </div>

                <div class="col-md-3">
                    <div class="text-muted small mb-2">Jumlah Jenis Barang</div>
                    <h5 class="fw-bold mb-0">
                        {{ $penjualan->detailPenjualans->count() }} item
                    </h5>
                </div>

            </div>
        </div>
    </div>

    {{-- Tabel Detail Barang --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Daftar Barang</h5>
                <span class="badge text-bg-light border">
                    {{ $penjualan->detailPenjualans->count() }} item
                </span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Barang</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($penjualan->detailPenjualans as $detail)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                    </div>
                                    <div class="text-muted small">
                                        ID Barang: {{ $detail->barang_id }}
                                    </div>
                                </td>

                                <td class="text-end">
                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </td>

                                <td class="text-center">
                                    {{ $detail->jumlah }}
                                </td>

                                <td class="text-end fw-semibold">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        Belum ada detail barang untuk transaksi ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Ringkasan Total --}}
    <div class="row justify-content-end">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Jenis Barang</span>
                        <span class="fw-semibold">
                            {{ $penjualan->detailPenjualans->count() }} item
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Penjualan</span>
                        <h4 class="fw-bold mb-0 text-primary">
                            Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
