@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">
                Bahan Baku
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                Kelola data dan stok bahan baku yang digunakan untuk resep menu
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('ingredients.create') }}"
               class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200">
                <iconify-icon icon="solar:leaf-linear" width="20"></iconify-icon>
                Tambah Bahan Baku
            </a>

            <a href="{{ route('stocks.index') }}"
               class="inline-flex items-center gap-2 border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold px-5 py-3 rounded-xl transition-all duration-200">
                <iconify-icon icon="solar:archive-minimalistic-linear" width="20"></iconify-icon>
                Riwayat Stok
            </a>
        </div>
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 rounded-xl flex items-center gap-2">
            <iconify-icon icon="solar:check-circle-linear" class="text-emerald-600" width="20"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                <tr>
                    <th class="px-6 py-4 text-left">Nama Bahan Baku</th>
                    <th class="px-6 py-4 text-center w-48">Stok Tersedia</th>
                    <th class="px-6 py-4 text-center w-48">Satuan</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($ingredients as $ingredient)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4">
                        <span class="font-semibold text-dark">{{ $ingredient->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-center font-bold font-mono {{ $ingredient->stock <= 5 ? 'text-rose-600' : 'text-slate-700' }}">
                        {{ (float)$ingredient->stock }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                            {{ $ingredient->unit }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-400 font-medium">
                        Belum ada data bahan baku
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @forelse ($ingredients as $ingredient)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="font-semibold text-dark text-base">{{ $ingredient->name }}</div>

            <div class="mt-2 grid grid-cols-2 gap-2 text-xs border-t border-slate-50 pt-2.5">
                <div>
                    <span class="text-slate-400">Stok:</span>
                    <span class="font-bold font-mono block {{ $ingredient->stock <= 5 ? 'text-rose-600' : 'text-slate-700' }}">{{ (float)$ingredient->stock }}</span>
                </div>
                <div>
                    <span class="text-slate-400">Satuan:</span>
                    <span class="font-medium text-slate-600 block">{{ $ingredient->unit }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8">
            Belum ada data bahan baku
        </div>
        @endforelse
    </div>

</div>
@endsection
