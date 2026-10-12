@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Tambah Pembelian</h2>
                <p class="text-info mb-0">Catat barang masuk ke gudang</p>
            </div>

            <a href="{{ url('/pembelian') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <form>
            <div class="row g-4">

                {{-- Form Pembelian --}}
                <div class="col-lg-8">

                    <div class="card border-secondary rounded-4 mb-4" style="backgorund-color: #101116;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-receipt me-2"></i>
                                Informasi Pembelian
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Tanggal Pembelian
                                    </label>
                                    <input type="date" name="tanggal_pembelian" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Referensi / No. Faktur
                                    </label>
                                    <input type="text" class="form-control" placeholder="Contoh: INV-2026-001">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control" rows="3" placeholder="Catatan tambahan (opsional)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Barang Masuk --}}
                    <div class="card border-secondary rounded-4 mb-4" style="backgorund-color: #101116;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-box-seam me-2"></i>
                                Barang Masuk
                            </h5>

                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Pilih Barang</label>
                                    <select class="form-select">
                                        <option value="">Pilih barang...</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" min="1" value="1">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">
                                        Harga Beli / Unit
                                    </label>
                                    <input type="number" class="form-control" min="0" placeholder="0">
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary w-100">
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Barang
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table table-dark table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga Beli</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center text-secondary py-4">
                                                Belum ada barang yang ditambahkan.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="col-lg-4">
                    <div class="card border-secondary rounded-4" style="backgorund-color: #101116;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-calculator me-2"></i>
                                Ringkasan Pembelian
                            </h5>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Total Jenis Barang</span>
                                <strong>0</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Total Kuantitas</span>
                                <strong>0</strong>
                            </div>

                            <hr class="border-secondary">

                            <p class="text-secondary mb-1">Total Pembelian</p>
                            <h3 class="fw-bold mb-4">Rp 0</h3>

                            <button type="button" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-floppy me-1"></i>
                                Simpan Pembelian
                            </button>

                            <a href="{{ url('/pembelian') }}" class="btn btn-outline-light w-100">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
