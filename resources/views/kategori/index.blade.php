@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Data Kategori</h2>

        <a href="/kategori/tambah" class="btn btn-primary mb-3">
            + Tambah Kategori
        </a>

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $kategori->nama_kategori }}
                            </td>

                            <td class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        Aksi
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="/kategori/edit/{{ $kategori->id }}">
                                                Edit
                                            </a>
                                        </li>

                                        <li>
                                            <form action="/kategori/hapus/{{ $kategori->id }}" method="POST">
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
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection
