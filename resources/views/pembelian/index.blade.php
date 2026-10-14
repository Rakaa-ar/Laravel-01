@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Data Pembelian</h2>
            <p class="text-info mb-0">
                Riwayat pembelian barang dari supplier
            </p>
        </div>

        <a href="{{ url('/pembelian/tambah') }}" class="btn btn-primary">
            <i class="bi bi-cart-plus me-1"></i>
            Tambah Pembelian
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="card border-secondary rounded-4 mb-4"
         style="background-color:#101116;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <i class="bi bi-receipt me-2"></i>
                Ringkasan Pembelian
            </h5>

            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total Transaksi Pembelian</span>
                <strong>{{ $pembelians->count() }} transaksi</strong>
            </div>

            <hr class="border-secondary">

            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total Nilai Pembelian</span>
                <strong class="text-info">
                    Rp {{ number_format($pembelians->sum('total'), 0, ',', '.') }}
                </strong>
            </div>
        </div>
    </div>

    {{-- Riwayat dan Informasi Pembelian --}}
    <div class="row g-4">

        {{-- Container kiri: Riwayat --}}
        <div class="col-lg-7">
            <div class="card border-secondary rounded-4 h-100"
                 style="background-color:#101116;">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-clock-history me-2"></i>
                        Riwayat Pembelian
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($pembelians as $pembelian)
                                    <tr
                                        class="baris-pembelian"
                                        role="button"
                                        tabindex="0"
                                        data-faktur="{{ $pembelian->referensi ?? $pembelian->no_faktur ?? '-' }}"
                                        data-supplier="{{ $pembelian->supplier->nama_supplier ?? '-' }}"
                                        data-catatan="{{ $pembelian->catatan ?? '-' }}"
                                        data-tanggal="{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d-m-Y') }}"
                                        data-total="Rp {{ number_format($pembelian->total, 0, ',', '.') }}"
                                    >
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $pembelian->supplier->nama_supplier ?? '-' }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($pembelian->total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="text-center text-secondary py-4">
                                            Belum ada riwayat pembelian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <small class="text-secondary">
                        <i class="bi bi-info-circle me-1"></i>
                        Pilih transaksi untuk melihat informasinya.
                    </small>

                </div>
            </div>
        </div>

        {{-- Container kanan: Informasi --}}
        <div class="col-lg-5">
            <div class="card border-secondary rounded-4 h-100"
                 style="background-color:#101116;">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Informasi Pembelian
                    </h5>

                    <div class="mb-4">
                        <div class="text-secondary small mb-1">No. Faktur</div>
                        <h6 class="fw-bold mb-0" id="infoFaktur">-</h6>
                    </div>

                    <hr class="border-secondary">

                    <div class="mb-4">
                        <div class="text-secondary small mb-1">Tanggal Pembelian</div>
                        <div id="infoTanggal">-</div>
                    </div>

                    <hr class="border-secondary">

                    <div class="mb-4">
                        <div class="text-secondary small mb-1">Nama Supplier</div>
                        <div class="fw-semibold" id="infoSupplier">-</div>
                    </div>

                    <hr class="border-secondary">

                    <div class="mb-4">
                        <div class="text-secondary small mb-1">Catatan</div>
                        <p class="mb-0 text-break" id="infoCatatan">
                            Pilih transaksi untuk melihat catatan.
                        </p>
                    </div>

                    <hr class="border-secondary">

                    <div>
                        <div class="text-secondary small mb-1">Total Pembelian</div>
                        <h4 class="fw-bold text-info mb-0" id="infoTotal">
                            Rp 0
                        </h4>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .baris-pembelian {
        cursor: pointer;
        transition: background-color .2s ease;
    }

    .baris-pembelian.aktif td {
        background-color: #20243a;
    }

    .baris-pembelian:focus-visible {
        outline: 2px solid #6366f1;
        outline-offset: -2px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const barisPembelian = document.querySelectorAll('.baris-pembelian');

    function tampilkanInformasi(baris) {
        document.querySelectorAll('.baris-pembelian').forEach(function (item) {
            item.classList.remove('aktif');
        });

        baris.classList.add('aktif');

        document.getElementById('infoFaktur').textContent =
            baris.dataset.faktur || '-';

        document.getElementById('infoTanggal').textContent =
            baris.dataset.tanggal || '-';

        document.getElementById('infoSupplier').textContent =
            baris.dataset.supplier || '-';

        document.getElementById('infoCatatan').textContent =
            baris.dataset.catatan || '-';

        document.getElementById('infoTotal').textContent =
            baris.dataset.total || 'Rp 0';
    }

    barisPembelian.forEach(function (baris, index) {
        baris.addEventListener('click', function () {
            tampilkanInformasi(baris);
        });

        baris.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                tampilkanInformasi(baris);
            }
        });

        // Otomatis tampilkan transaksi pertama saat halaman dibuka
        if (index === 0) {
            tampilkanInformasi(baris);
        }
    });

    // Alert hilang otomatis setelah 3 detik
    document.querySelectorAll('.alert').forEach(function (element) {
        setTimeout(function () {
            if (element.isConnected && window.bootstrap) {
                bootstrap.Alert.getOrCreateInstance(element).close();
            }
        }, 3000);
    });
});
</script>
@endsection