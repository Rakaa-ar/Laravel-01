@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Tambah Pembelian</h2>
                <p class="text-info mb-0">Catat pembelian dan stok masuk gudang</p>
            </div>

            <a href="{{ url('/pembelian') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ url('/pembelian/tambah') }}" method="POST" id="formPembelian">
            @csrf

            <div class="row g-4 align-items-start">

                {{-- Kolom Kiri --}}
                <div class="col-lg-8">

                    {{-- Informasi Pembelian --}}
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
                                        class="form-control" value="{{ old('tanggal_pembelian', date('Y-m-d')) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="supplier_id" class="form-label">
                                        Supplier
                                    </label>

                                    <select name="supplier_id" id="supplier_id" class="form-select" required>

                                        <option value="">Pilih supplier...</option>

                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>
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
                                        value="{{ old('referensi') }}" placeholder="Contoh: INV-2026-001">
                                </div>

                                <div class="col-12">
                                    <label for="catatan" class="form-label">
                                        Catatan
                                    </label>

                                    <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Detail Barang --}}
                    <div class="card rounded-4" style="background-color:#111216; border-color:#303238;">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-box-seam me-2"></i>
                                Detail Barang
                            </h5>

                            <div class="row g-3 align-items-end">

                                <div class="col-md-5">
                                    <label for="barang_id" class="form-label">
                                        Pilih Barang
                                    </label>

                                    <select id="barang_id" class="form-select">
                                        <option value="">Pilih barang...</option>

                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}"
                                                data-harga="{{ $barang->harga }}">
                                                {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="jumlah" class="form-label">
                                        Jumlah
                                    </label>

                                    <input type="number" id="jumlah" class="form-control" min="1" step="1"
                                        value="1">
                                </div>

                                <div class="col-md-3">
                                    <label for="harga" class="form-label">
                                        Harga Barang
                                    </label>

                                    <input type="text" id="harga" class="form-control"
                                        placeholder="Pilih Barang Terlebih Dahulu" readonly>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" id="tambahBarang" class="btn text-white"
                                        style="background-color:#0d6efd; border-color:#0d6efd;">

                                        <i class="bi bi-plus-lg me-1"></i>
                                        Tambah Barang
                                    </button>
                                </div>

                            </div>

                            {{-- Tabel Detail --}}
                            <div class="table-responsive mt-4">
                                <table class="table table-dark table-hover align-middle mb-0">

                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga Beli</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="daftarBarang">
                                        <tr>
                                            <td colspan="5" class="text-center text-secondary py-4">
                                                Belum ada barang ditambahkan.
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>

                            {{-- Input detail yang dikirim ke controller --}}
                            <div id="inputDetail"></div>

                        </div>
                    </div>

                </div>

                {{-- Kolom Kanan --}}
                <div class="col-lg-4">

                    <div class="card rounded-4" style="background-color:#111216; border-color:#303238;">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-calculator me-2"></i>
                                Ringkasan Pembelian
                            </h5>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Total Jenis Barang</span>
                                <strong id="totalJenis">0</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-secondary">Total Kuantitas</span>
                                <strong id="totalKuantitas">0</strong>
                            </div>

                            <hr class="border-secondary">

                            <div class="text-secondary mb-2">
                                Total Pembelian
                            </div>

                            <h3 class="fw-bold mb-4" id="totalPembelian">
                                Rp 0
                            </h3>

                            <button type="submit" id="simpanPembelian" class="btn btn-primary w-100 mb-2" disabled>

                                <i class="bi bi-save me-1"></i>
                                Simpan Pembelian
                            </button>

                            <a href="{{ url('/pembelian') }}" class="btn btn-outline-light w-100">
                                Batal
                            </a>

                        </div>
                    </div>

                    <div class="mt-3 text-secondary small">
                        <i class="bi bi-info-circle me-1"></i>
                        Stok akan diperbarui setelah pembelian berhasil disimpan.
                    </div>

                </div>

            </div>
        </form>
    </div>

    <script>
        const barangSelect = document.getElementById('barang_id');
        const jumlahInput = document.getElementById('jumlah');
        const hargaInput = document.getElementById('harga');
        const tombolTambah = document.getElementById('tambahBarang');
        const daftarBarang = document.getElementById('daftarBarang');
        const inputDetail = document.getElementById('inputDetail');
        const tombolSimpan = document.getElementById('simpanPembelian');
        const formPembelian = document.getElementById('formPembelian');

        let items = [];

        // Format angka menjadi Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        // Tampilkan harga otomatis saat barang dipilih
        barangSelect.addEventListener('change', function() {
            const option = this.options[this.selectedIndex];

            if (!option.value) {
                hargaInput.value = '';
                return;
            }

            const harga = Number(option.dataset.harga);

            hargaInput.value = Number.isFinite(harga) ?
                formatRupiah(harga) :
                '';
        });

        // Render tabel detail dan hitung total
        function renderBarang() {
            daftarBarang.innerHTML = '';
            inputDetail.innerHTML = '';

            let total = 0;
            let kuantitas = 0;

            items.forEach((item, index) => {
                const subtotal = item.jumlah * item.harga;

                total += subtotal;
                kuantitas += item.jumlah;

                const baris = document.createElement('tr');

                const nama = document.createElement('td');
                nama.textContent = item.nama;

                const jumlah = document.createElement('td');
                jumlah.textContent = item.jumlah;

                const harga = document.createElement('td');
                harga.textContent = formatRupiah(item.harga);

                const nilaiSubtotal = document.createElement('td');
                nilaiSubtotal.textContent = formatRupiah(subtotal);

                const aksi = document.createElement('td');
                const tombolHapus = document.createElement('button');

                tombolHapus.type = 'button';
                tombolHapus.className = 'btn btn-sm btn-danger';
                tombolHapus.textContent = 'Hapus';

                tombolHapus.addEventListener('click', function() {
                    hapusBarang(index);
                });

                aksi.appendChild(tombolHapus);
                baris.append(nama, jumlah, harga, nilaiSubtotal, aksi);
                daftarBarang.appendChild(baris);

                // Input tersembunyi untuk dikirim ke controller
                [
                    ['barang_id', item.barang_id],
                    ['jumlah', item.jumlah],
                    ['harga', item.harga]
                ].forEach(([field, value]) => {
                    const input = document.createElement('input');

                    input.type = 'hidden';
                    input.name = `items[${index}][${field}]`;
                    input.value = value;

                    inputDetail.appendChild(input);
                });
            });

            if (items.length === 0) {
                daftarBarang.innerHTML = `
            <tr>
                <td colspan="5"
                    class="text-center text-secondary py-4">
                    Belum ada barang ditambahkan.
                </td>
            </tr>
        `;
            }

            document.getElementById('totalJenis').textContent = items.length;
            document.getElementById('totalKuantitas').textContent = kuantitas;
            document.getElementById('totalPembelian').textContent =
                formatRupiah(total);

            tombolSimpan.disabled = items.length === 0;
        }

        // Tambahkan barang ke tabel
        tombolTambah.addEventListener('click', function() {
            const barangId = barangSelect.value;
            const option = barangSelect.options[barangSelect.selectedIndex];

            if (!barangId) {
                alert('Pilih barang terlebih dahulu.');
                return;
            }

            const hargaData = option.dataset.harga;

            if (
                hargaData === undefined ||
                hargaData === '' ||
                !Number.isFinite(Number(hargaData)) ||
                Number(hargaData) < 0
            ) {
                alert('Harga barang tidak valid.');
                return;
            }

            const nama = option.dataset.nama;
            const harga = Number(hargaData);
            const jumlah = Number(jumlahInput.value);

            if (!Number.isInteger(jumlah) || jumlah < 1) {
                alert('Jumlah harus berupa bilangan bulat minimal 1.');
                return;
            }

            // Jika barang yang sama dipilih lagi, gabungkan jumlahnya
            const itemLama = items.find(
                item => item.barang_id === barangId
            );

            if (itemLama) {
                itemLama.jumlah += jumlah;
            } else {
                items.push({
                    barang_id: barangId,
                    nama: nama,
                    jumlah: jumlah,
                    harga: harga
                });
            }

            renderBarang();

            // Reset input setelah barang ditambahkan
            barangSelect.value = '';
            jumlahInput.value = 1;
            hargaInput.value = '';
        });

        // Hapus barang dari tabel
        function hapusBarang(index) {
            items.splice(index, 1);
            renderBarang();
        }

        // Cegah form dikirim jika belum ada barang
        formPembelian.addEventListener('submit', function(event) {
            if (items.length === 0) {
                event.preventDefault();
                alert('Tambahkan minimal satu barang sebelum menyimpan pembelian.');
            }
        });

        // Tampilan awal
        renderBarang();
    </script>
@endsection
