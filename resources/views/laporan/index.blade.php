@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Laporan Transaksi</h2>
            <a href="{{ route('laporan.pdf', request()->query()) }}" class="btn btn-danger">
                Cetak PDF
            </a>
        </div>

        <!-- Form Filter Tanggal -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('Laporan.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control"
                            value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control"
                            value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter Data</button>
                        <a href="{{ route('Laporan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header border-bottom border-secondary" style="background-color: transparent;">
                <h5>Data Penjualan (Uang Masuk)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Penjualan</th>
                                <th>ID Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggal_penjualan }}</td>
                                    <td>TRX-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <!-- Bikin ID jadi keliatan kayak nomor nota -->
                                    <td>{{ $item->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td> <!-- Ganti jadi total -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data penjualan pada rentang tanggal
                                        ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <th colspan="4" class="text-end border-0" style="color: #fff;">Total Keseluruhan Uang
                                    Masuk:</th>
                                <th class="border-0" style="color: #0dcaf0; font-size: 1.1rem;">Rp
                                    {{ number_format($penjualan->sum('total'), 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header border-bottom border-secondary" style="background-color: transparent;">
                <h5>Data Pembelian (Uang Keluar)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembelian</th>
                                <th>Referensi / Faktur</th>
                                <th>Supplier/Gudang</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembelian as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggal_pembelian }}</td>
                                    <td>{{ $item->referensi ?? '-' }}</td>
                                    <td>{{ $item->supplier->nama_supplier ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pembelian pada rentang tanggal
                                        ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </tbody>
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <th colspan="4" class="text-end border-0" style="color: #fff;">Total Keseluruhan Uang
                                    Keluar:</th>
                                <th class="border-0" style="color: #0dcaf0; font-size: 1.1rem;">Rp
                                    {{ number_format($pembelian->sum('total'), 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
