<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
</head>
<body>
    <h1>Tambah Menu Baru</h1>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        <label>Nama Menu:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Deskripsi Menu:</label><br>
        <input type="text" name="description" value="{{ old('description') }}"><br><br>

        <label>Kategori:</label><br>
        <select name="category_id">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select><br><br>

        <label>Harga:</label><br>
        <input type="number" name="price" step="100"><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="active">Aktif</option>
            <option value="inactive">Tidak Aktif</option>
        </select><br><br>

        <label>Bahan (Ingredients):</label><br>
        <div id="ingredients-wrapper">
            <div class="ingredient-group">
                <select name="ingredients[0][ingredient_id]">
                    @foreach($allIngredients as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                    @endforeach
                </select>
                <input type="number" name="ingredients[0][quantity]" placeholder="Jumlah" min="1" step="0.01">
                <button type="button" onclick="removeIngredient(this)">🗑</button>
            </div>
        </div>
        <br>
        <button type="button" onclick="addIngredient()">+ Tambah Bahan</button>
        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('menu.index') }}">← Kembali</a>

    <script>
    let ingredientIndex = 1;

    function addIngredient() {
        const wrapper = document.getElementById('ingredients-wrapper');
        const newGroup = document.createElement('div');
        newGroup.classList.add('ingredient-group');

        newGroup.innerHTML = `
            <select name="ingredients[${ingredientIndex}][ingredient_id]">
                @foreach($allIngredients as $ing)
                    <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                @endforeach
            </select>
            <input type="number" name="ingredients[${ingredientIndex}][quantity]" placeholder="Jumlah" min="1" step="0.01">
            <button type="button" onclick="removeIngredient(this)">🗑</button>
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
