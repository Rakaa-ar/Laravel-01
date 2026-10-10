@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="mb-4">
            <h3 class="fw-bold mb-1">Tambah Penjualan</h3>
            <p class="text-muted mb-0">
                Buat transaksi penjualan baru
            </p>
        </div>

        {{-- Breadcrumb --}}
        <div class="mb-4">
            <span class="text-muted">Penjualan</span>
            <span class="mx-2">/</span>
            <span>Tambah Penjualan</span>
        </div>

        {{-- Form --}}
        <form action="/penjualan/tambah" method="POST" id="formTambah">
            @csrf

            <div class="card">
                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Informasi Penjualan
                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">
                                Detail Barang
                            </h5>

                            <button type="button" class="btn btn-primary" id="btnTambahBarang">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah Barang
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th width="120">Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="detailBarang">
                                    <tr>
                                        <td>
                                            <select name="barang_id[]" class="form-select barang-select" required>
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                                        {{ $barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control jumlah-input"
                                                value="1" min="1" required>
                                        </td>

                                        <td class="harga-barang">
                                            Rp 0
                                        </td>

                                        <td class="subtotal-barang">
                                            Rp 0
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button"
                                                            class="dropdown-item text-danger btn-hapus-barang">
                                                            <i class="bi bi-trash me-2"></i>
                                                            Hapus
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </h5>

                    <div class="row g-3">

                        {{-- Tanggal --}}
                        <div class="col-md-6">
                            <label for="tanggal_penjualan" class="form-label">
                                Tanggal Penjualan
                            </label>

                            <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        {{-- Pelanggan --}}
                        <div class="col-md-6">
                            <label for="pelanggan_id" class="form-label">
                                Pelanggan
                            </label>

                            <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>

                                <option value="">-- Pilih Pelanggan --</option>

                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">
                                        {{ $pelanggan->nama_pelanggan }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Total Penjualan</h5>

                        <div class="fs-4 fw-bold" id="totalPenjualan">
                            Rp 0
                        </div>

                        <input type="hidden" name="total" id="totalInput" value="0">
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="/penjualan" class="btn btn-secondary">
                    Batal
                </a>

                <button type="submit" class="btn btn-primary" id="btnSimpan">
                    <i class="bi bi-save me-1"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>
    <script>
        document.getElementById('formTambah').addEventListener('submit', function() {
            const button = document.getElementById('btnSimpan');

            button.disabled = true;
            button.innerText = 'Menyimpan...';
        });

        const detailBarang = document.getElementById('detailBarang');
        const btnTambahBarang = document.getElementById('btnTambahBarang');

        function hitungTotal() {
            let total = 0;

            detailBarang.querySelectorAll('tr').forEach(function(row) {
                const select = row.querySelector('.barang-select');
                const jumlah = row.querySelector('.jumlah-input');
                const harga = Number(
                    select.options[select.selectedIndex]?.dataset.harga || 0
                );

                const subtotal = harga * Number(jumlah.value || 0);

                row.querySelector('.harga-barang').textContent =
                    'Rp ' + harga.toLocaleString('id-ID');

                row.querySelector('.subtotal-barang').textContent =
                    'Rp ' + subtotal.toLocaleString('id-ID');

                total += subtotal;
            });

            document.getElementById('totalPenjualan').textContent =
                'Rp ' + total.toLocaleString('id-ID');

            document.getElementById('totalInput').value = total;
        }

        function pasangEvent(row) {
            row.querySelector('.barang-select')
                .addEventListener('change', hitungTotal);

            row.querySelector('.jumlah-input')
                .addEventListener('input', hitungTotal);

            row.querySelector('.btn-hapus-barang')
                .addEventListener('click', function() {
                    if (detailBarang.querySelectorAll('tr').length > 1) {
                        row.remove();
                        hitungTotal();
                    }
                });
        }

        btnTambahBarang.addEventListener('click', function() {
            const barisPertama = detailBarang.querySelector('tr');
            const barisBaru = barisPertama.cloneNode(true);

            barisBaru.querySelector('.barang-select').selectedIndex = 0;
            barisBaru.querySelector('.jumlah-input').value = 1;

            detailBarang.appendChild(barisBaru);
            pasangEvent(barisBaru);
            hitungTotal();
        });

        detailBarang.querySelectorAll('tr').forEach(pasangEvent);
        hitungTotal();
    </script>
@endsection
