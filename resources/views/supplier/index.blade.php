@extends('layouts.app')

@section('title', 'Data Supplier')

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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Data Supplier</h1>

            <a href="/supplier/tambah" class="btn btn-primary">
                + Tambah Supplier
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Penanggung Jawab</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $supplier->nama_supplier }}
                            </td>

                            <td>
                                {{ $supplier->nama_penanggung_jawab }}
                            </td>

                            <td>
                                {{ $supplier->no_telepon }}
                            </td>

                            <td>
                                {{ $supplier->alamat }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        ⋮
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="/supplier/edit/{{ $supplier->id }}">
                                                ✏️ Edit
                                            </a>
                                        </li>

                                        <form action="/supplier/delete/{{ $supplier->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="dropdown-item">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
