@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

    <div class="container mt-4">
        <h2>Data Kategori</h2>

        @forelse ($kategoris as $kategori)
            <p>{{ $kategori->nama_kategori }}</p>

        @empty
            <p>Belum ada data kategori.</p>
        @endforelse
    </div>
@endsection