<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .form-control, .form-select {
            height: 50px;
            font-size: 16px;
        }

        .ingredient-group {
            margin-bottom: 10px;
        }

        .ingredient-group select, .ingredient-group input {
            margin-right: 10px;
        }

        .ingredient-group button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .ingredient-group button:hover {
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

    <div class="container">
        <h1 class="text-center">Tambah Menu Baru</h1>

        <!-- Add Menu Form -->
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Menu</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Foto Menu</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Bahan (Ingredients)</label>
                <div id="ingredients-wrapper">
                    <div class="ingredient-group">
                        <select name="ingredients[0][ingredient_id]" class="form-select">
                            @foreach($allIngredients as $ing)
                                <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                            @endforeach
                        </select>
                        <input type="number" name="ingredients[0][quantity]" placeholder="Jumlah" min="1" step="0.01" class="form-control" required>
                        <button type="button" onclick="removeIngredient(this)">🗑</button>
                    </div>
                </div>
                <button type="button" onclick="addIngredient()" class="btn btn-secondary">+ Tambah Bahan</button>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>

        <!-- Back Link -->
        <div class="back-link">
            <a href="{{ route('menu.index') }}">← Kembali</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let ingredientIndex = 1;

        function addIngredient() {
            const wrapper = document.getElementById('ingredients-wrapper');
            const newGroup = document.createElement('div');
            newGroup.classList.add('ingredient-group');

            newGroup.innerHTML = `
                <select name="ingredients[${ingredientIndex}][ingredient_id]" class="form-select">
                    @foreach($allIngredients as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                    @endforeach
                </select>
                <input type="number" name="ingredients[${ingredientIndex}][quantity]" placeholder="Jumlah" min="1" step="0.01" class="form-control" required>
                <button type="button" onclick="removeIngredient(this)" class="btn btn-danger">🗑</button>
            `;

            wrapper.appendChild(newGroup);
            ingredientIndex++;
        }

        function removeIngredient(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
