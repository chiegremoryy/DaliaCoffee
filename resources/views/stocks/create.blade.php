@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('stocks.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Tambah Stok Masuk</h2>
        </div>
        <p class="text-sm text-slate-400">
            Catat penambahan stok bahan baku yang masuk ke gudang
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
    <form method="POST" action="{{ route('stocks.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="ingredientSelect" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Pilih Bahan Baku
            </label>
            <select
                name="ingredient_id"
                id="ingredientSelect"
                onchange="updateStockInfo()"
                required
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
                <option value="">Pilih Bahan Baku</option>
                @foreach ($ingredients as $ing)
                    <option
                        value="{{ $ing->id }}"
                        data-stock="{{ $ing->stock }}"
                        data-unit="{{ $ing->unit }}">
                        {{ $ing->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Stock Info Display -->
        <div id="stockInfo" class="hidden rounded-xl bg-slate-50 border border-slate-100 p-4 text-sm text-slate-600 flex items-center gap-2">
            <iconify-icon icon="solar:info-circle-linear" class="text-primary" width="18"></iconify-icon>
            <div>
                <strong>Stok Saat Ini:</strong>
                <span id="stockValue" class="font-bold text-dark font-mono ml-1"></span>
            </div>
        </div>

        <div>
            <label for="quantity" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Jumlah Tambahan (Stok Masuk)
            </label>
            <input
                type="number"
                name="quantity"
                id="quantity"
                min="1"
                required
                placeholder="Masukkan jumlah tambahan"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
        </div>

        <input type="hidden" name="type" value="in">

        <div>
            <label for="description" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Keterangan / Catatan (Opsional)
            </label>
            <textarea
                name="description"
                id="description"
                rows="3"
                placeholder="Contoh: Pembelian supplier, Restock mingguan"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all"></textarea>
        </div>

        <button
            type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
            Simpan Stok Masuk
        </button>
    </form>

</div>

@push('scripts')
<script>
    function updateStockInfo() {
        const select = document.getElementById('ingredientSelect');
        const selectedOption = select.options[select.selectedIndex];

        const stock = selectedOption.getAttribute('data-stock');
        const unit = selectedOption.getAttribute('data-unit');

        const info = document.getElementById('stockInfo');
        const value = document.getElementById('stockValue');

        if (stock && unit) {
            value.innerText = `${parseFloat(stock)} ${unit}`;
            info.classList.remove('hidden');
        } else {
            info.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection