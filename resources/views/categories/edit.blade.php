@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('categories.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Edit Kategori</h2>
        </div>
        <p class="text-sm text-slate-400">
            Perbarui data kategori produk menu
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
    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Nama Kategori
            </label>
            <input
                type="text"
                id="name"
                name="name"
                required
                value="{{ old('name', $category->name) }}"
                placeholder="Contoh: Kopi Susu, Makanan Utama, Camilan"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
        </div>

        <button
            type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
            Perbarui Kategori
        </button>
    </form>

</div>
@endsection