@extends('layouts.app')

@section('title', 'Data Gudang')

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
                        <h2 class="mb-1">Data Gudang</h2>
                        <p class="text-muted mb-0">
                            Kelola data gudang
                        </p>
                    </div>

                    <a href="/gudang/tambah" class="btn btn-primary">
                        + Tambah Gudang
                    </a>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gudang</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($gudang as $item)
                                <tr>
                                    <td>
                                        {{ ($gudang->currentPage() - 1) * $gudang->perPage() + $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->nama_gudang }}
                                    </td>

                                    <td>
                                        {{ $item->alamat ?? '-' }}
                                    </td>

                                    <td>
                                        <a href="/gudang/edit/{{ $item->id }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="/gudang/delete/{{ $item->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Belum ada data gudang.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $gudang->links() }}
                    </div>


                </div>

            </div>
        </div>

    </div>

@endsection
