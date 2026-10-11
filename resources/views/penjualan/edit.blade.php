@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mx-auto" style="max-width: 100px;">

        </div>

        <div class="mb-4">
            <h3 class="fw-bold mb-1">Edit Penjualan</h3>
            <p class="text-muted mb-0">Perbarui transaksi dan detail barang</p>
        </div>

        <div class="mb-4 small">
            <a href="/penjualan" class="text-decoration-none">Penjualan</a>
            <span class="text-muted mx-2">/</span>
            <span>Edit #{{ $penjualan->id }}</span>
        </div>


        <form action="/penjualan/update/{{ $penjualan->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="tanggal_penjualan" class="form-label">
                                        Tanggal Penjualan
                                    </label>
                                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan"
                                        class="form-control" value="{{ $penjualan->tanggal_penjualan }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="pelanggan_id" class="form-label">
                                        Pelanggan
                                    </label>
                                    <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                                        @foreach ($pelanggans as $pelanggan)
                                            <option value="{{ $pelanggan->id }}"
                                                {{ $penjualan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                                                {{ $pelanggan->nama_pelanggan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                            <h5 class="fw-semibold mb-0">Detail Barang</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="tambahBarang">
                                <i class="bi bi-plus-lg me-1"></i>Tambah Barang
                            </button>
                        </div>

                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="daftarBarang">
                                        @foreach ($penjualan->detailPenjualans as $detail)
                                            <tr>
                                                <td>
                                                    <select name="barang_id[]" class="form-select pilih-barang" required>
                                                        @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}"
                                                                data-harga="{{ $barang->harga }}"
                                                                {{ $detail->barang_id == $barang->id ? 'selected' : '' }}>
                                                                {{ $barang->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="harga-barang text-nowrap">
                                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <input type="number" name="jumlah[]" class="form-control jumlah-barang"
                                                        min="1" value="{{ $detail->jumlah }}" required>
                                                </td>
                                                <td class="subtotal-barang text-nowrap">
                                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger hapus-barang">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">
                                Total Penjualan    
                            </span>
                            <h4 class="fw-bold text-primary mb-0" id="totalTampilan">Rp 0</h4>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="/penjualan" class="btn btn-secondary">
                            Batal</a>

                        <button type="submit" class="btn btn-primary" id="btnSimpan">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        const daftarBarang = document.getElementById('daftarBarang');
        const totalTampilan = document.getElementById('totalTampilan');

        const formatRupiah = angka =>
            'Rp ' + Number(angka).toLocaleString('id-ID');

        function hitungTotal() {
            let total = 0;

            daftarBarang.querySelectorAll('tr').forEach(baris => {
                const pilihan = baris.querySelector('.pilih-barang');
                const jumlahInput = baris.querySelector('.jumlah-barang');
                const harga = Number(pilihan.selectedOptions[0]?.dataset.harga || 0);
                const jumlah = Number(jumlahInput.value || 0);
                const subtotal = harga * jumlah;

                baris.querySelector('.harga-barang').textContent = formatRupiah(harga);
                baris.querySelector('.subtotal-barang').textContent = formatRupiah(subtotal);

                total += subtotal;
            });

            totalTampilan.textContent = formatRupiah(total);
        }

        function buatBarisBarang() {
            const baris = document.createElement('tr');

            baris.innerHTML = `
            <td>
                <select name="barang_id[]" class="form-select pilih-barang" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                            {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td class="harga-barang text-nowrap">Rp 0</td>
            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah-barang"
                       min="1" value="1" required>
            </td>
            <td class="subtotal-barang text-nowrap">Rp 0</td>
            <td>
                <button type="button" class="btn btn-sm btn-outline-danger hapus-barang">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

            daftarBarang.appendChild(baris);
            hitungTotal();
        }

        document.getElementById('tambahBarang').addEventListener('click', buatBarisBarang);

        daftarBarang.addEventListener('input', hitungTotal);
        daftarBarang.addEventListener('change', hitungTotal);

        daftarBarang.addEventListener('click', function(event) {
            const tombol = event.target.closest('.hapus-barang');

            if (tombol) {
                if (daftarBarang.querySelectorAll('tr').length <= 1) {
                    alert('Minimal harus ada satu barang.');
                    return;
                }

                tombol.closest('tr').remove();
                hitungTotal();
            }
        });

        hitungTotal();
    </script>
@endsection
