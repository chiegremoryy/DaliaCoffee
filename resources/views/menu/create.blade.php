<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru | Dalia Coffee</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 248, 240, 0.95);
            backdrop-filter: blur(10px);
        }

        .coffee-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234e342e' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4] coffee-pattern p-6">

    <div class="max-w-3xl mx-auto glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#3e2723] mb-2">
                Tambah Menu Baru
            </h1>
            <p class="text-sm text-[#6d4c41]">
                Tambahkan menu baru beserta bahan dan harganya
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Menu -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Nama Menu
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Deskripsi Menu
                </label>
                <input type="text" name="description" value="{{ old('description') }}" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Kategori
                </label>
                <select name="category_id" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Harga & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                        Harga
                    </label>
                    <input type="number" name="price" value="{{ old('price') }}" required
                        class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                               focus:outline-none focus:border-[#6d4c41]
                               focus:ring-4 focus:ring-[#d7ccc8] transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                        Status
                    </label>
                    <select name="status" required
                        class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                               focus:outline-none focus:border-[#6d4c41]
                               focus:ring-4 focus:ring-[#d7ccc8] transition-all">
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <!-- Foto -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Foto Menu
                </label>
                <input type="file" name="image" accept="image/*"
                    class="w-full rounded-xl border-2 border-[#d7ccc8] bg-white
                           file:mr-4 file:py-3 file:px-4
                           file:rounded-xl file:border-0
                           file:bg-[#efebe9] file:text-[#4e342e]
                           hover:file:bg-[#e0d6d1] transition-all">
            </div>

            <!-- Ingredients -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-3">
                    Bahan (Ingredients)
                </label>

                <div id="ingredients-wrapper" class="space-y-3">
                    <div class="ingredient-group flex flex-col sm:flex-row gap-3 items-center">
                        <select name="ingredients[0][ingredient_id]"
                            class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                                   focus:outline-none focus:border-[#6d4c41]
                                   focus:ring-4 focus:ring-[#d7ccc8] transition-all">
                            @foreach($allIngredients as $ing)
                                <option value="{{ $ing->id }}">
                                    {{ $ing->name }} ({{ $ing->unit }})
                                </option>
                            @endforeach
                        </select>

                        <input type="number" name="ingredients[0][quantity]" min="1" step="0.01" placeholder="Jumlah" required
                            class="w-full sm:w-32 h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                                   focus:outline-none focus:border-[#6d4c41]
                                   focus:ring-4 focus:ring-[#d7ccc8] transition-all">

                        <button type="button" onclick="removeIngredient(this)"
                            class="h-14 px-5 rounded-xl bg-red-100 text-red-600 font-semibold hover:bg-red-200">
                            🗑
                        </button>
                    </div>
                </div>

                <button type="button" onclick="addIngredient()"
                    class="mt-4 px-6 py-3 rounded-xl bg-[#efebe9] text-[#4e342e]
                           font-semibold hover:bg-[#e0d6d1] transition-all">
                    + Tambah Bahan
                </button>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41]
                       text-white font-semibold py-4 rounded-xl
                       hover:from-[#4e342e] hover:to-[#5d4037]
                       transform hover:scale-[1.02]
                       transition-all duration-300 shadow-lg hover:shadow-xl">
                Simpan Menu
            </button>
        </form>

        <!-- Back -->
        <div class="mt-6 text-center">
            <a href="{{ route('menu.index') }}"
               class="text-sm font-semibold text-[#5d4037]
                      hover:text-[#4e342e]
                      underline decoration-2 underline-offset-4">
                Back to Menu List
            </a>
=======
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Menu Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('menu._form', ['menu' => null, 'menuIngredients' => []])

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{ route('menu.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
        </div>

    </div>
<<<<<<< HEAD

    <!-- JS (logic tetap) -->
    <script>
        let ingredientIndex = 1;

        function addIngredient() {
            const wrapper = document.getElementById('ingredients-wrapper');
            const div = document.createElement('div');
            div.className = 'ingredient-group flex flex-col sm:flex-row gap-3 items-center';

            div.innerHTML = `
                <select name="ingredients[${ingredientIndex}][ingredient_id]"
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all">
                    @foreach($allIngredients as $ing)
                        <option value="{{ $ing->id }}">
                            {{ $ing->name }} ({{ $ing->unit }})
                        </option>
                    @endforeach
                </select>

                <input type="number" name="ingredients[${ingredientIndex}][quantity]" min="1" step="0.01" placeholder="Jumlah" required
                    class="w-full sm:w-32 h-14 px-4 rounded-xl border-2 border-[#d7ccc8]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all">

                <button type="button" onclick="removeIngredient(this)"
                    class="h-14 px-5 rounded-xl bg-red-100 text-red-600 font-semibold hover:bg-red-200">
                    🗑
                </button>
            `;

            wrapper.appendChild(div);
            ingredientIndex++;
        }

        function removeIngredient(button) {
            button.parentElement.remove();
        }
    </script>

</body>
</html>
=======
</div>
@endsection
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
