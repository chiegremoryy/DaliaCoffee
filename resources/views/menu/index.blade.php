<!DOCTYPE html>
<html>
<head>
    <title>Kelola Menu</title>
</head>
<body>
    <h1>Daftar Menu</h1>

    <a href="{{ route('menu.create') }}">+ Tambah Menu</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->category->name ?? '-' }}</td>
                <td>Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                <td>{{ $menu->status }}</td>
                <td>
                    <a href="{{ route('menu.edit', $menu->id) }}">Edit</a>
                    <a href="{{ route('menu.show', $menu->id) }}">More</a>
                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
