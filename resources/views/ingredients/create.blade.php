@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('ingredients.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Tambah Bahan Baku</h2>
        </div>
        <p class="text-sm text-slate-400">
            Tambahkan bahan baku baru beserta stok dan satuannya ke sistem
        </p>
    </div>

    <!-- Error Validation -->
    @if($errors->any())
        <div class="mb-6 bg-rose-50 text-rose-800 border border-rose-100 px-4 py-3 rounded-xl space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <iconify-icon icon="solar:info-circle-linear" class="text-rose-500" width="16"></iconify-icon>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('ingredients.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Nama Bahan Baku
            </label>
            <input
                type="text"
                id="name"
                name="name"
                required
                value="{{ old('name') }}"
                placeholder="Contoh: Gula Aren, Biji Kopi Arabika"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="unit" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Satuan Ukur
                </label>
                <input
                    type="text"
                    id="unit"
                    name="unit"
                    required
                    value="{{ old('unit') }}"
                    placeholder="Contoh: gr, ml, pcs"
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
            </div>

            <div>
                <label for="stock" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Stok Awal
                </label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    min="0"
                    required
                    value="{{ old('stock', 0) }}"
                    placeholder="0"
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
            </div>
        </div>

        <button
            type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
            Simpan Bahan Baku
        </button>
    </form>

</div>
@endsection
