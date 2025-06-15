<h1>Tambah Bahan Baku</h1>

<form action="{{ route('ingredients.store') }}" method="POST">
    @csrf

    <label>Nama Bahan:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="unit" placeholder="misal: gr, butir, bungkus" required><br><br>

    <label>Stok Awal:</label><br>
    <input type="number" name="stock" min="0" required><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('ingredients.index') }}">← Kembali ke daftar</a>
