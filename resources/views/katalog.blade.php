<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu</title>

    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .menu-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .menu-item img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .menu-item h4 {
            margin-bottom: 5px;
            font-size: 1.25rem;
        }

        .menu-item p {
            margin-bottom: 0;
        }

        .menu-item .price {
            font-weight: bold;
            color: #28a745;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Daftar Menu</h1>

        <div class="row">
            @foreach ($menus as $menu)
            <div class="col-md-4">
                <div class="menu-item">
                    <!-- Image if exists -->
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-fluid">
                    @endif
                    <h4>{{ $menu->name }}</h4>
                    <p class="price">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                    <p><small>{{ $menu->description }}</small></p>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
