<!-- resources/views/katalog.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Katalog Menu</title>
</head>
<body>
    <h1>Daftar Menu</h1>

    <ul>
        @foreach ($menus as $menu)
            <li>
                <strong>{{ $menu->name }}</strong> - Rp{{ number_format($menu->price, 0, ',', '.') }} <br>
                <small>{{ $menu->description }}</small>
            </li>
        @endforeach
    </ul>
</body>
</html>
