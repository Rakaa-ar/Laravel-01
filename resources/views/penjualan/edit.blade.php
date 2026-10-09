@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="mb-4">
            <h3 class="fw-bold mb-1">Edit Penjualan</h3>
            <p class="text-muted mb-0">
                Perbarui informasi penjualan
            </p>
        </div>

        <div class="mb-4">
            <span class="text-muted">Penjualan</span>
            <span class="mx-2">/</span>
            <span>Edit Penjualan</span>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="/penjualan/update/{{ $penjualan->id }}" method="POST" id="formEdit">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tanggal_penjualan" class="form-label">
                            Tanggal Penjualan
                        </label>

                        <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control"
                            value="{{ $penjualan->tanggal_penjualan }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">
                            Pelanggan
                        </label>

                        <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>

                            <option value="">-- Pilih Pelanggan --</option>

                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}"
                                    {{ $penjualan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                                    {{ $pelanggan->nama_pelanggan }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">
                            Total Penjualan
                        </label>

                        <div class="input-group">
                          <span class="input-group-text rupiah-prefix">Rp</span>
                        <input type="text" name="total" id="total" class="form-control"
                            value="{{ number_format($penjualan->total, 0, ',', '.') }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/penjualan" class="btn btn-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary" id="btnUpdate">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script>
      const totalInput = document.getElementById('total');
        totalInput.addEventListener('input', function() {
            let angka = this.value.replace(/\D/g, '');
            this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        });

        document.getElementById('formEdit').addEventListener('submit', function() {
            const button = document.getElementById('btnUpdate');
            button.disabled = true;
            button.innerText = 'Menyimpan...';
        });
    </script>
@endsection
