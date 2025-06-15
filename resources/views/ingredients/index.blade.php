<h1>Daftar Bahan Baku</h1>
<a href="{{ route('ingredients.create') }}">+ Tambah Bahan Baku</a><br><br>
<a href="{{ route('stocks.index') }}">→ Lihat Riwayat Stok</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Stok</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->name }}</td>
                <td>{{ $ingredient->stock }}</td>
                <td>{{ $ingredient->unit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
