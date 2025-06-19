<div class="mb-3">
    <label for="name">Nama Menu</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description">Deskripsi Menu</label>
    <input type="text" name="description" class="form-control" value="{{ old('description', $menu->description ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="category_id">Kategori</label>
    <select name="category_id" class="form-select" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ isset($menu) && $menu->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="price">Harga</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="status">Status</label>
    <select name="status" class="form-select" required>
        <option value="active" {{ isset($menu) && $menu->status == 'active' ? 'selected' : '' }}>Aktif</option>
        <option value="inactive" {{ isset($menu) && $menu->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
    </select>
</div>

<div class="mb-3">
    <label for="image">Foto Menu</label>
    <input type="file" name="image" class="form-control">
    @if(isset($menu) && $menu->image)
        <img src="{{ asset('storage/' . $menu->image) }}" class="img-thumbnail mt-2" style="max-height: 150px;">
    @endif
</div>

<h5>Bahan</h5>
<div id="ingredient-wrapper">
    @foreach($menuIngredients as $i => $ing)
        <div class="row mb-2">
            <div class="col-md-6">
                <select name="ingredients[{{ $i }}][ingredient_id]" class="form-select">
                    @foreach($allIngredients as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $ing->ingredient_id ? 'selected' : '' }}>
                            {{ $item->name }} ({{ $item->unit }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="ingredients[{{ $i }}][quantity]" class="form-control" value="{{ $ing->quantity }}" required>
            </div>
        </div>
    @endforeach
    @if(empty($menuIngredients))
        <div class="row mb-2">
            <div class="col-md-6">
                <select name="ingredients[0][ingredient_id]" class="form-select">
                    @foreach($allIngredients as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->unit }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="ingredients[0][quantity]" class="form-control" required>
            </div>
        </div>
    @endif
</div>
