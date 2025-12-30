<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu | {{ $menu->name }}</title>

    <!-- Tailwind -->
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
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%234e342e' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4] coffee-pattern p-6">

    <div class="w-full max-w-3xl glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl text-[#3e2723] mb-2">Edit Menu</h1>
            <p class="text-sm text-[#6d4c41]">
                Perbarui detail menu <strong>{{ $menu->name }}</strong>
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ old('name', $menu->name) }}" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8]">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] mb-2">Deskripsi</label>
                <input type="text" name="description" value="{{ old('description', $menu->description) }}" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] mb-2">Kategori</label>
                <select name="category_id" class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $menu->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-[#4e342e] mb-2">Harga</label>
                    <input type="number" name="price" value="{{ old('price', $menu->price) }}" required
                        class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#4e342e] mb-2">Status</label>
                    <select name="status" class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8]">
                        <option value="active" {{ $menu->status == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $menu->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <!-- Foto -->
            <div class="border-t border-[#d7ccc8] pt-6">
                <label class="block text-sm font-medium text-[#4e342e] mb-4">Foto Menu</label>

                <div class="flex flex-col sm:flex-row gap-6">
                    <div>
                        @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}"
                            class="w-40 rounded-xl border shadow">
                        @else
                        <div class="w-40 h-28 flex items-center justify-center border-2 border-dashed rounded-xl text-sm text-[#8d6e63]">
                            Tidak ada gambar
                        </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <input type="file" name="image"
                            class="block w-full text-sm
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:bg-[#6d4c41] file:text-white
                               hover:file:bg-[#5d4037]">
                    </div>
                </div>
            </div>

            <!-- Ingredients -->
            <div class="border-t border-[#d7ccc8] pt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-[#3e2723]">Bahan Menu</h3>
                    <button type="button" onclick="addIngredient()"
                        class="text-sm font-semibold text-[#5d4037] hover:underline">
                        + Tambah Bahan
                    </button>
                </div>

                <div id="ingredient-list" class="space-y-3">
                    @foreach($menuIngredients as $index => $ingredient)
                    <div class="grid grid-cols-1 sm:grid-cols-[1fr_120px_48px] gap-3 items-center
                                bg-[#fffaf5] border border-[#d7ccc8] rounded-2xl p-4">
                        <select name="ingredients[{{ $index }}][ingredient_id]"
                            class="h-12 px-3 rounded-xl border-2 border-[#d7ccc8]">
                            @foreach($allIngredients as $ing)
                            <option value="{{ $ing->id }}"
                                {{ $ing->id == $ingredient->ingredient_id ? 'selected' : '' }}>
                                {{ $ing->name }} ({{ $ing->unit }})
                            </option>
                            @endforeach
                        </select>

                        <input type="number" name="ingredients[{{ $index }}][quantity]"
                            value="{{ $ingredient->quantity }}" min="1"
                            class="h-12 px-3 rounded-xl border-2 border-[#d7ccc8]">

                        <button type="button" onclick="removeIngredient(this)"
                            class="h-12 w-12 rounded-xl bg-red-100 text-red-600
                                   hover:bg-red-500 hover:text-white transition">
                            🗑
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41]
                   text-white py-4 rounded-xl font-semibold hover:scale-[1.02] transition">
                Update Menu
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('menu.index') }}" class="text-sm text-[#5d4037] underline">
                Back to Menu List
            </a>
        </div>
    </div>

</body>

</html>