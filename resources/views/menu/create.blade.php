@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('menu.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Tambah Menu Baru</h2>
        </div>
        <p class="text-sm text-slate-400">
            Tambahkan produk menu baru beserta detail bahan baku yang digunakan
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
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama & Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Nama Menu
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Espresso Romano"
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
            </div>

            <div>
                <label for="category_id" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Kategori
                </label>
                <select id="category_id" name="category_id" required
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Deskripsi Menu
            </label>
            <input type="text" id="description" name="description" value="{{ old('description') }}" required placeholder="Tuliskan deskripsi singkat menu"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
        </div>

        <!-- Harga & Status -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="price" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Harga (Rp)
                </label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required placeholder="Contoh: 25000"
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
            </div>

            <div>
                <label for="status" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Status Menu
                </label>
                <select id="status" name="status" required
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- Foto -->
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Foto Menu
            </label>
            <input type="file" name="image" accept="image/*"
                class="w-full rounded-xl border border-slate-200 bg-white text-sm text-slate-500
                       file:mr-4 file:py-3 file:px-4
                       file:rounded-xl file:border-0
                       file:text-xs file:font-semibold
                       file:bg-secondary file:text-primary
                       hover:file:bg-primary/10 transition-all">
        </div>

        <!-- Ingredients Section -->
        <div class="border-t border-slate-100 pt-6">
            <div class="flex justify-between items-center mb-4">
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Bahan Baku (Ingredients)
                </label>
                <button type="button" onclick="addIngredient()"
                    class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                    <iconify-icon icon="solar:add-circle-linear" width="16"></iconify-icon>
                    Tambah Bahan
                </button>
            </div>

            <div id="ingredients-wrapper" class="space-y-3">
                <div class="ingredient-group grid grid-cols-1 sm:grid-cols-[1fr_120px_48px] gap-3 items-center bg-slate-50/50 border border-slate-100 rounded-xl p-3">
                    <select name="ingredients[0][ingredient_id]" required
                        class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">
                        @foreach($allIngredients as $ing)
                            <option value="{{ $ing->id }}">
                                {{ $ing->name }} ({{ $ing->unit }})
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="ingredients[0][quantity]" min="1" step="0.01" placeholder="Jumlah" required
                        class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">

                    <button type="button" onclick="removeIngredient(this)"
                        class="h-11 w-11 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition-colors">
                        <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
            Simpan Menu Baru
        </button>
    </form>

</div>

@push('scripts')
<script>
    let ingredientIndex = 1;
    const ingredientsWrapper = document.getElementById('ingredients-wrapper');
    const ingredientOptionsHtml = `@foreach($allIngredients as $ing)<option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>@endforeach`;

    function addIngredient() {
        const div = document.createElement('div');
        div.className = 'ingredient-group grid grid-cols-1 sm:grid-cols-[1fr_120px_48px] gap-3 items-center bg-slate-50/50 border border-slate-100 rounded-xl p-3';
        div.innerHTML = `
            <select name="ingredients[${ingredientIndex}][ingredient_id]" required
                class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">
                ${ingredientOptionsHtml}
            </select>

            <input type="number" name="ingredients[${ingredientIndex}][quantity]" min="1" step="0.01" placeholder="Jumlah" required
                class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">

            <button type="button" onclick="removeIngredient(this)"
                class="h-11 w-11 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition-colors">
                <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
            </button>
        `;
        ingredientsWrapper.appendChild(div);
        ingredientIndex++;
    }

    function removeIngredient(button) {
        const group = button.closest('.ingredient-group');
        const allGroups = ingredientsWrapper.querySelectorAll('.ingredient-group');
        if (allGroups.length > 1) {
            group.remove();
        } else {
            Swal.fire({
                title: 'Info',
                text: 'Menu minimal harus memiliki satu bahan baku.',
                icon: 'info',
                confirmButtonColor: '#5802f7'
            });
        }
    }
</script>
@endpush
@endsection