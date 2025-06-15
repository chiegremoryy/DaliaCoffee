<h1>Riwayat Stok</h1>
<a href="{{ route('stocks.create') }}">+ Tambah Transaksi</a><br><br>
<a href="{{ route('ingredients.index') }}">Lihat Daftar Bahan Baku</a><br><br>

@if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Bahan</th>
            <th>Jumlah</th>
            <th>Jenis</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
    <tr>
        <td>{{ $stock->created_at->format('d-m-Y H:i') }}</td>
        <td>{{ $stock->ingredient->name }}</td>
        <td>{{ $stock->quantity }} {{ $stock->ingredient->unit }}</td>
        <td>{{ $stock->type }}</td>
        <td>{{ $stock->description }}</td>
        <td>
            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus histori ini?')">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach
    </tbody>
</table>

<br><br>

<h2>Total Stok Saat Ini</h2>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Bahan</th>
            <th>Stok Tersedia</th>
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
