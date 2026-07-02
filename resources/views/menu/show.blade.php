@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8 border-b border-slate-100 pb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('menu.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Detail Menu</h2>
        </div>
        <p class="text-sm text-slate-400">
            Informasi lengkap resep dan harga produk menu kedai
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-[250px_1fr] gap-8">
        <!-- Left Side: Image -->
        <div class="flex flex-col items-center">
            @if ($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full max-w-[250px] aspect-square object-cover rounded-2xl border border-slate-100 shadow-sm">
            @else
                <div class="w-full max-w-[250px] aspect-square rounded-2xl bg-slate-50 border border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 text-sm">
                    <iconify-icon icon="solar:gallery-linear" class="mb-2" width="40"></iconify-icon>
                    <span>Tidak ada foto menu</span>
                </div>
            @endif
        </div>

        <!-- Right Side: Details -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-dark font-poppins">{{ $menu->name }}</h1>
                <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-semibold
                    {{ $menu->status === 'active'
                        ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                        : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                    {{ $menu->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 border-y border-slate-100 py-4 text-sm">
                <div>
                    <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Kategori</span>
                    <span class="font-semibold text-dark">{{ $menu->category->name ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Harga</span>
                    <span class="font-bold text-primary text-base">Rp{{ number_format($menu->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div>
                <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Deskripsi</span>
                <p class="text-slate-600 text-sm leading-relaxed">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>

            <!-- Ingredients List -->
            <div>
                <span class="text-xs text-slate-400 uppercase tracking-wider block mb-3">Bahan Baku yang Digunakan</span>
                @if($menu->menuIngredients->count() > 0)
                    <div class="bg-slate-50/50 rounded-xl border border-slate-100 divide-y divide-slate-100 overflow-hidden">
                        @foreach($menu->menuIngredients as $mi)
                            <div class="flex items-center justify-between p-3.5 text-sm">
                                <span class="font-semibold text-dark">{{ $mi->ingredient->name }}</span>
                                <span class="text-slate-500 font-mono">{{ (float)$mi->quantity }} {{ $mi->ingredient->unit }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-400 text-sm italic">Tidak ada bahan baku yang terdaftar untuk menu ini.</p>
                @endif
            </div>

            <div class="pt-4 flex gap-3">
                <a href="{{ route('menu.edit', $menu->id) }}"
                   class="inline-flex items-center justify-center gap-2 bg-primary text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all text-sm">
                    <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
                    Edit Menu
                </a>
                <a href="{{ route('menu.index') }}"
                   class="inline-flex items-center justify-center gap-2 border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold px-5 py-2.5 rounded-xl transition-all text-sm">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
