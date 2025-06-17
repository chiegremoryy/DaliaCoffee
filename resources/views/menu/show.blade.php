<!DOCTYPE html>
<html>
<head>
    <title>Detail Menu</title>
</head>
<body>
    <h1>Detail Menu: {{ $menu->name }}</h1>

    @if ($menu->image)
        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="250">
    @else
        <p><em>Tidak ada gambar untuk menu ini.</em></p>
    @endif

    <p><strong>Kategori:</strong> {{ $menu->category->name ?? '-' }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ $menu->status }}</p>
    <p><strong>Deskripsi:</strong> {{ $menu->description ?? '-' }}</p>

    <h3>Bahan yang Digunakan:</h3>
    @if($menu->menuIngredients->count() > 0)
        <ul>
            @foreach($menu->menuIngredients as $mi)
                <li>
                    {{ $mi->ingredient->name }} ({{ $mi->quantity }} {{ $mi->ingredient->unit }})
                </li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada bahan terdaftar untuk menu ini.</p>
    @endif

    <br>
    <a href="{{ route('menu.index') }}">← Kembali ke daftar menu</a>
</body>
</html>
