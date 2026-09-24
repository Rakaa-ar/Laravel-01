@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>

            <script>
                setTimeout(function() {
                    const alert = document.querySelector('.alert');
                    if (alert) {
                        alert.remove();
                    }
                }, 3000);
            </script>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">Data Barang</h2>
                        <p class="text-muted mb-0">
                            Kelola data barang inventori gudang
                        </p>
                    </div>

                    <a href="/inventori/tambah" class="btn btn-primary">
                        + Tambah Barang
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($barangs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge text-bg-secondary">
                                            BRG-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $item->nama_barang }}</strong>
                                    </td>
                                    <td>
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $item->satuan->nama_satuan ?? '-' }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ $item->stok }}
                                    </td>

                                    <td class="text-center">

                                        <a href="/inventori/edit/{{ $item->id }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="/inventori/delete/{{ $item->id }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus">
                                                Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $barangs->links() }}
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        const tombolHapus = document.querySelectorAll('.btn-hapus');

        tombolHapus.forEach(function(button) {
            button.addEventListener('click', function(event) {
                const yakin = confirm('Yakin ingin menghapus barang ini?');

                if (!yakin) {
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection
