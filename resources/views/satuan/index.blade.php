@extends('layouts.app')

@section('title', 'Data Satuan')

@section('content')

    <div class="container mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h2 class="mb-4">Data Satuan</h2>

                <a href="/satuan/tambah" class="btn btn-primary mb-3">
                    + Tambah Satuan
                </a>
                  
                    <table class="table table-dark table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Satuan</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($satuans as $satuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $satuan->nama_satuan }}
                                    </td>

                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                Aksi
                                            </button>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="/satuan/edit/{{ $satuan->id }}">
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <form action="/satuan/hapus/{{ $satuan->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="dropdown-item">
                                                            Hapus
                                                        </button>

                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center">
                                        Belum ada data Satuan.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>
    </div>

@endsection
