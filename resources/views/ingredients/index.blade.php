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
                Tambah Bahan Baku
            </a>

            <a href="{{ route('stocks.index') }}"
               class="inline-flex items-center gap-2
                      bg-[#8d6e63] text-white font-semibold
                      px-5 py-3 rounded-xl hover:bg-[#6d4c41] transition">
                <i class="fas fa-boxes-stacked"></i>
                Riwayat Stok
            </a>
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
@endsection
