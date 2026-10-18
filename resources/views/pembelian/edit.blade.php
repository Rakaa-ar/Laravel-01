@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row g-4 align-items-start justify-content-center">
            <div class="col-12 col-xl-8">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-primary">EDIT TRANSAKSI</span>
                            <span class="text-secondary small">
                                #{{ $pembelian->id }}
                            </span>
                        </div>

                        <h2 class="fw-bold mb-1">Edit Pembelian</h2>
                        <p class="text-info mb-0">
                            Perbarui informasi dan detail barang pembelian
                        </p>
                    </div>

                    <a href="{{ url('/pembelian') }}" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>

                <form action="{{ url('/pembelian/update/' . $pembelian->id) }}" method="POST" id="formPembelian">

                    @csrf
                    @method('PUT')

                    <div class="row g-4 align-items-start">

                        <div class="col-12 col-xl-12">

                            <div class="card rounded-4 mb-4" style="background-color:#111216; border-color:#303238;">

                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-4">
                                        <i class="bi bi-receipt me-2"></i>
                                        Informasi Pembelian
                                    </h5>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label for="tanggal_pembelian" class="form-label">
                                                Tanggal Pembelian
                                            </label>

                                            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian"
                                                class="form-control"
                                                value="{{ old('tanggal_pembelian', $pembelian->tanggal_pembelian) }}"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="supplier_id" class="form-label">
                                                Supplier
                                            </label>

                                            <select name="supplier_id" id="supplier_id" class="form-select" required>

                                                <option value="">
                                                    Pilih supplier...
                                                </option>

                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" @selected(old('supplier_id', $pembelian->supplier_id) == $supplier->id)>
                                                        {{ $supplier->nama_supplier }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="referensi" class="form-label">
                                                Referensi / No. Faktur
                                            </label>

                                            <input type="text" name="referensi" id="referensi" class="form-control"
                                                value="{{ old('referensi', $pembelian->referensi) }}"
                                                placeholder="Contoh: INV-2026-001">
                                        </div>

                                        <div class="col-12">
                                            <label for="catatan" class="form-label">
                                                Catatan
                                            </label>

                                            <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('catatan', $pembelian->catatan) }}</textarea>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="bi bi-save me-2"></i>
                                                Simpan Perubahan
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Barang --}}
                        <div class="card rounded-4 mb-4" style="background-color:#111216; border-color:#303238;">

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold mb-0">
                                        <i class="bi bi-box-seam me-2"></i>
                                        Detail Barang
                                    </h5>

                                    <button type="button" class="btn btn-outline-info btn-sm" id="tambahBarang">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Tambah Barang
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-dark table-bordered align-middle">
                                        <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Subtotal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="daftarBarang">
                                            @foreach ($pembelian->detailPembelians as $index => $detail)
                                                <tr class="baris-barang">
                                                    <td>
                                                        <select name="items[{{ $index }}][barang_id]"
                                                            class="form-select barang-id" required>
                                                            <option value="" data-harga="0">Pilih barang</option>

                                                            @foreach ($barangs as $barang)
                                                                {{-- Gua tambahin data-harga biar JS bisa narik angkanya --}}
                                                                <option value="{{ $barang->id }}"
                                                                    data-harga="{{ $barang->harga }}"
                                                                    @selected($detail->barang_id == $barang->id)>
                                                                    {{ $barang->nama_barang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][jumlah]"
                                                            class="form-control jumlah-barang"
                                                            value="{{ $detail->jumlah }}" min="1" required>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][harga]"
                                                            class="form-control harga-barang" value="{{ (int) $detail->harga }}"
                                                            min="0" step="any" required>
                                                    </td>

                                                    <td>
                                                        <span class="subtotal-barang">
                                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm hapus-barang">
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
                        <div class="col-lg-4">
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>

    <script>
        const daftarBarang = document.getElementById('daftarBarang');
        const tombolTambah = document.getElementById('tambahBarang');
        let indeksBarang = daftarBarang.querySelectorAll('.baris-barang').length;

        function hitungSubtotal(baris) {
            const jumlah = Number(baris.querySelector('.jumlah-barang').value) || 0;
            const harga = Number(baris.querySelector('.harga-barang').value) || 0;

            const subtotal = jumlah * harga;

            baris.querySelector('.subtotal-barang').textContent =
                'Rp ' + subtotal.toLocaleString('id-ID');
        }

        daftarBarang.addEventListener('input', function(event) {
            const baris = event.target.closest('.baris-barang');

            if (baris && (
                    event.target.classList.contains('jumlah-barang') ||
                    event.target.classList.contains('harga-barang')
                )) {
                hitungSubtotal(baris);
            }
        });

        // Bagian baru buat otomatis ngisi harga pas dropdown diganti
        daftarBarang.addEventListener('change', function(event) {
            if (event.target.classList.contains('barang-id')) {
                const baris = event.target.closest('.baris-barang');
                const opsiDipilih = event.target.options[event.target.selectedIndex];
                const hargaBaru = opsiDipilih.getAttribute('data-harga') || 0;

                baris.querySelector('.harga-barang').value = hargaBaru;
                hitungSubtotal(baris);
            }
        });

        daftarBarang.addEventListener('click', function(event) {
            const tombolHapus = event.target.closest('.hapus-barang');

            if (tombolHapus) {
                const baris = tombolHapus.closest('.baris-barang');
                baris.remove();
            }
        });

        daftarBarang.querySelectorAll('.baris-barang').forEach(function(baris) {
            const inputHarga = baris.querySelector('.harga-barang');
            if (inputHarga && inputHarga.value) {
                inputHarga.value = Math.round(Number(inputHarga.value));
            }
            hitungSubtotal(baris);
        });

        // Simpan template baris (ambil dari baris pertama pas load)
        const templateBaris = daftarBarang.querySelector('.baris-barang') ? daftarBarang.querySelector('.baris-barang')
            .cloneNode(true) : null;

        tombolTambah.addEventListener('click', function() {
            // Ambil referensi, utamain baris pertama, kalau kosong ambil dari template
            let referensiBaris = daftarBarang.querySelector('.baris-barang') || templateBaris;

            if (!referensiBaris) {
                alert("Tidak ada baris barang yang bisa diclone!");
                return;
            }

            const barisBaru = referensiBaris.cloneNode(true);

            barisBaru.querySelectorAll('input').forEach(function(input) {
                input.value = input.classList.contains('jumlah-barang') ? 1 : 0;
            });

            barisBaru.querySelectorAll('select').forEach(function(select) {
                select.selectedIndex = 0;
            });

            barisBaru.querySelectorAll('.subtotal-barang').forEach(function(subtotal) {
                subtotal.textContent = 'Rp 0';
            });

            barisBaru.querySelectorAll('[name]').forEach(function(input) {
                // Perbaikan di baris ini: pakai name bukan nama, dan pakai backtick
                input.name = input.name.replace(/items\[\d+\]/, `items[${indeksBarang}]`);
            });

            indeksBarang++;

            daftarBarang.appendChild(barisBaru);
        });
    </script>
@endsection
