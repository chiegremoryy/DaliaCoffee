<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <style>
        .ingredient-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Edit Menu: {{ $menu->name }}</h1>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form Menu -->
        <label>Nama Menu:</label><br>
        <input type="text" name="name" value="{{ old('name', $menu->name) }}"><br><br>

        <label>Deskripsi Menu:</label><br>
        <input type="text" name="description" value="{{ old('description', $menu->description)}}"><br><br>

        <label>Kategori:</label><br>
        <select name="category_id">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $menu->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Harga:</label><br>
        <input type="number" name="price" value="{{ old('price', $menu->price) }}"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="active" {{ $menu->status == 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ $menu->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
        </select><br><br>

        <!-- Bahan -->
        <h3>Bahan</h3>
        <div id="ingredient-list">
            @foreach($menuIngredients as $index => $ingredient)
                <div class="ingredient-item">
                    <select name="ingredients[{{ $index }}][ingredient_id]">
                        @foreach($allIngredients as $ing)
                            <option value="{{ $ing->id }}" {{ $ing->id == $ingredient->ingredient_id ? 'selected' : '' }}>
                                {{ $ing->name }} ({{ $ing->unit }})
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="ingredients[{{ $index }}][quantity]" value="{{ $ingredient->quantity }}" min="1">
                    <button type="button" onclick="removeIngredient(this)">🗑</button>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addIngredient()">+ Tambah Bahan</button><br><br>
        <button type="submit">Update Menu</button>
    </form>

    <a href="{{ route('menu.index') }}">← Kembali</a>

    <script>
        let ingredientIndex = {{ count($menuIngredients) }};

        function addIngredient() {
            const list = document.getElementById('ingredient-list');
            const newItem = document.createElement('div');
            newItem.className = 'ingredient-item';

            newItem.innerHTML = `
                <select name="ingredients[${ingredientIndex}][ingredient_id]">
                    @foreach($allIngredients as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                    @endforeach
                </select>
                <input type="number" name="ingredients[${ingredientIndex}][quantity]" min="1" value="1">
                <button type="button" onclick="removeIngredient(this)">🗑</button>
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
