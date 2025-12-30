@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Bahan Baku
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Kelola stok bahan baku
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="{{ route('ingredients.create') }}"
               class="inline-flex items-center gap-2
                      bg-[#5d4037] text-white font-semibold
                      px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
                <i class="fas fa-plus"></i>
                Tambah
            </a>

<<<<<<< HEAD
            <a href="{{ route('stocks.index') }}"
               class="inline-flex items-center gap-2
                      bg-[#8d6e63] text-white font-semibold
                      px-5 py-3 rounded-xl hover:bg-[#6d4c41] transition">
                <i class="fas fa-boxes-stacked"></i>
                Riwayat Stok
            </a>
=======
            <!-- Tombol aksi -->
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex gap-2">
                    <!-- Tombol trigger modal -->
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addIngredientModal">
                        <i class="fas fa-plus me-1"></i> Tambah Bahan Baku
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-boxes-stacked me-1"></i> Lihat Riwayat Stok
                    </a>
                </div>
            </div>

            <!-- Tabel bahan baku -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
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
                            <td class="text-start">{{ $ingredient->name }}</td>
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
            </div>
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 text-green-800 px-5 py-3">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4 text-center w-32">Stok</th>
                    <th class="px-6 py-4 text-center w-32">Satuan</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse ($ingredients as $ingredient)
                <tr>
                    <td class="px-6 py-4">{{ $ingredient->name }}</td>
                    <td class="px-6 py-4 text-center font-semibold">
                        {{ $ingredient->stock }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $ingredient->unit }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-[#6d4c41]">
                        Belum ada bahan baku
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @forelse ($ingredients as $ingredient)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723] text-lg">
                {{ $ingredient->name }}
            </div>

            <div class="mt-2 text-sm text-[#6d4c41]">
                <div>Stok: <span class="font-semibold">{{ $ingredient->stock }}</span></div>
                <div>Satuan: {{ $ingredient->unit }}</div>
            </div>
        </div>
        @empty
        <div class="text-center text-[#6d4c41] py-6">
            Belum ada bahan baku
        </div>
        @endforelse
    </div>

</div>

<!-- Modal Tambah Bahan Baku -->
<div class="modal fade" id="addIngredientModal" tabindex="-1" aria-labelledby="addIngredientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ingredients.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addIngredientModalLabel">Tambah Bahan Baku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Bahan</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Satuan</label>
                        <input type="text" name="unit" id="unit" class="form-control" placeholder="misal: gr, butir, bungkus" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Awal</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS (Jika belum ada di layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
