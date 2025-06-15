<h1>Tambah Stok Masuk</h1>

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('stocks.store') }}">
    @csrf

    <label>Bahan:</label><br>
    <select name="ingredient_id" id="ingredientSelect" onchange="updateStockInfo()">
        <option value="">-- Pilih Bahan --</option>
        @foreach ($ingredients as $ing)
            <option 
                value="{{ $ing->id }}"
                data-stock="{{ $ing->stock }}"
                data-unit="{{ $ing->unit }}"
            >
                {{ $ing->name }}
            </option>
        @endforeach
    </select><br><br>

    <div id="stockInfo" style="margin-bottom: 10px; display: none;">
        <strong>Stok Saat Ini:</strong> <span id="stockValue"></span>
    </div>

    <label>Jumlah Tambahan:</label><br>
    <input type="number" name="quantity" min="1" required><br><br>

    <input type="hidden" name="type" value="in">

    <label>Deskripsi (opsional):</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('stocks.index') }}">← Kembali</a>

<script>
    function updateStockInfo() {
        const select = document.getElementById('ingredientSelect');
        const selectedOption = select.options[select.selectedIndex];

        const stock = selectedOption.getAttribute('data-stock');
        const unit = selectedOption.getAttribute('data-unit');

        if (stock && unit) {
            document.getElementById('stockValue').innerText = `${stock} ${unit}`;
            document.getElementById('stockInfo').style.display = 'block';
        } else {
            document.getElementById('stockInfo').style.display = 'none';
        }
    }
</script>
