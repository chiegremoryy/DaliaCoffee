@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Bahan Baku</h1>

    <!-- Tombol tambah bahan dan lihat stok -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">+ Tambah Bahan Baku</a>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">→ Lihat Riwayat Stok</a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel bahan baku -->
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->stock }}</td>
                    <td>{{ $ingredient->unit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada bahan baku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Link kembali -->
    <div class="mt-3">
        <a href="{{ route('home') }}">← Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection
