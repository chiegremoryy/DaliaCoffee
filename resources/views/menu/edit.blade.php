<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu: {{ $menu->name }}</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ingredient-item {
            margin-bottom: 10px;
        }
        .form-control, .form-select {
            height: 50px;
            font-size: 16px;
        }
        .ingredient-item select, .ingredient-item input {
            margin-right: 10px;
        }
        .ingredient-item button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .ingredient-item button:hover {
            background-color: #c0392b;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            text-decoration: none;
            color: #3498db;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Card Wrapper for the Form -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1>Edit Menu: {{ $menu->name }}</h1>
            </div>
            <div class="card-body">
                <!-- Edit Menu Form -->
                <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Menu</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Menu</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $menu->description) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $menu->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $menu->price) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="active" {{ $menu->status == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $menu->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Menu Saat Ini</label><br>
                        @if ($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="150"><br>
                        @else
                            <em>Tidak ada gambar</em><br>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ganti Foto Menu</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <h3 class="mb-3">Bahan</h3>
                    <div id="ingredient-list">
                        @foreach($menuIngredients as $index => $ingredient)
                            <div class="ingredient-item">
                                <select name="ingredients[{{ $index }}][ingredient_id]" class="form-select">
                                    @foreach($allIngredients as $ing)
                                        <option value="{{ $ing->id }}" {{ $ing->id == $ingredient->ingredient_id ? 'selected' : '' }}>
                                            {{ $ing->name }} ({{ $ing->unit }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" name="ingredients[{{ $index }}][quantity]" class="form-control" value="{{ $ingredient->quantity }}" min="1" required>
                                <button type="button" class="btn btn-danger" onclick="removeIngredient(this)">🗑</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-secondary" onclick="addIngredient()">+ Tambah Bahan</button><br><br>
                    <button type="submit" class="btn btn-primary w-100">Update Menu</button>
                </form>
            </div>
        </div>

        <!-- Back Link -->
        <div class="back-link mt-3">
            <a href="{{ route('menu.index') }}">← Kembali</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let ingredientIndex = {{ count($menuIngredients) }};

        function addIngredient() {
            const list = document.getElementById('ingredient-list');
            const newItem = document.createElement('div');
            newItem.className = 'ingredient-item';

            newItem.innerHTML = `
                <select name="ingredients[${ingredientIndex}][ingredient_id]" class="form-select">
                    @foreach($allIngredients as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                    @endforeach
                </select>
                <input type="number" name="ingredients[${ingredientIndex}][quantity]" class="form-control" min="1" value="1" required>
                <button type="button" class="btn btn-danger" onclick="removeIngredient(this)">🗑</button>
            `;

            list.appendChild(newItem);
            ingredientIndex++;
        }

        function removeIngredient(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
