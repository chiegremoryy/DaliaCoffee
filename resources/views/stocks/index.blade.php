@extends('layouts.app')

@section('content')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center border-bottom">
            <h2 class="mb-0 text-dark fw-semibold">Stok Bahan</h2>
        </div>

        <div class="card-body">
            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('stocks.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i> Tambah Stok Bahan
                </a>
                <a href="{{ route('ingredients.index') }}" class="btn btn-info text-white">
                    <i class="fas fa-list me-1"></i> Lihat Daftar Bahan Baku
                </a>
            </div>

            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tabel Riwayat Transaksi -->
            <h5 class="mt-4 mb-3 fw-semibold">Riwayat Transaksi Stok</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
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
                                <td>{{ ucfirst($stock->type) }}</td>
                                <td>{{ $stock->description }}</td>
                                <td>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus histori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada transaksi stok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Total Stok -->
            <h5 class="mt-5 mb-3 fw-semibold">Total Stok Saat Ini</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
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

        </div>
    </div>
</div>
@endsection
