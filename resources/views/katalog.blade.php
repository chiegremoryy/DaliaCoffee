<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | Dalia Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #d7ccc8, #a1887f);
            padding: 40px 0;
        }

        h1, h2 {
            color: #4e342e;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .menu-item {
            background-color: #fff8f0;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-item img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .menu-item h4 {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .menu-item .price {
            color: #6d4c41;
            font-weight: bold;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .menu-item p {
            color: #4e342e;
            font-size: 0.95rem;
        }

        .section-title {
            margin-top: 60px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1 class="text-center">Our Menu</h1>

    <!-- Section: Makanan -->
    <h2 class="section-title">Makanan</h2>
    <div class="row g-4">
        @foreach ($menus->where('category.name', 'Makanan') as $menu)
            <div class="col-md-4">
                <div class="menu-item">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                    @endif
                    <h4>{{ $menu->name }}</h4>
                    <p class="price">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                    <p><small>{{ $menu->description }}</small></p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Section: Minuman -->
    <h2 class="section-title">Minuman</h2>
    <div class="row g-4">
        @foreach ($menus->where('category.name', 'Minuman') as $menu)
            <div class="col-md-4">
                <div class="menu-item">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                    @endif
                    <h4>{{ $menu->name }}</h4>
                    <p class="price">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                    <p><small>{{ $menu->description }}</small></p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
