<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu: {{ $menu->name }}</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-image {
            max-width: 250px;
            margin-bottom: 20px;
        }
        .ingredient-list {
            list-style-type: none;
            padding-left: 0;
        }
        .ingredient-list li {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .back-link a {
            text-decoration: none;
            color: #3498db;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Card Wrapper for Menu Details -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1>Detail Menu: {{ $menu->name }}</h1>
            </div>
            <div class="card-body">
                <!-- Menu Image -->
                <div class="text-center">
                    @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-image">
                    @else
                        <p><em>Tidak ada gambar untuk menu ini.</em></p>
                    @endif
                </div>

                <!-- Menu Details -->
                <p><strong>Kategori:</strong> {{ $menu->category->name ?? '-' }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($menu->status) }}</p>
                <p><strong>Deskripsi:</strong> {{ $menu->description ?? '-' }}</p>

                <!-- Ingredients List -->
                <h3>Bahan yang Digunakan:</h3>
                @if($menu->menuIngredients->count() > 0)
                    <ul class="ingredient-list">
                        @foreach($menu->menuIngredients as $mi)
                            <li>{{ $mi->ingredient->name }} ({{ $mi->quantity }} {{ $mi->ingredient->unit }})</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada bahan terdaftar untuk menu ini.</p>
                @endif
            </div>
        </div>

        <!-- Back Link -->
        <div class="back-link mt-3 text-center">
            <a href="{{ route('menu.index') }}">← Kembali ke daftar menu</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
