@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Riwayat Stok</h1>

    <!-- Tombol Aksi -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('stocks.create') }}" class="btn btn-success">+ Tambah Transaksi</a>
        <a href="{{ route('ingredients.index') }}" class="btn btn-info">Lihat Daftar Bahan Baku</a>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Riwayat Transaksi -->
    <h4 class="mt-4">Riwayat Transaksi Stok</h4>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Bahan</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>{{ $stock->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $stock->ingredient->name }}</td>
                    <td>{{ $stock->quantity }} {{ $stock->ingredient->unit }}</td>
                    <td>{{ $stock->type }}</td>
                    <td>{{ $stock->description }}</td>
                    <td>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus histori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada transaksi stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabel Total Stok -->
    <h4 class="mt-5">Total Stok Saat Ini</h4>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>Bahan</th>
                <th>Stok Tersedia</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->stock }}</td>
                    <td>{{ $ingredient->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
