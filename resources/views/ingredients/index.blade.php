<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bahan Baku</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .alert {
            margin-bottom: 20px;
        }

        .btn-primary {
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th {
            background-color: #f8f9fa;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .back-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Bahan Baku</h1>

        <!-- Add Ingredient Button -->
        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">+ Tambah Bahan Baku</a><br><br>
        <a href="{{ route('stocks.index') }}" class="btn btn-primary">→ Lihat Riwayat Stok</a>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Ingredients Table -->
        <table class="table table-bordered table-hover">
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

        <!-- Back Link -->
        <div class="back-link">
            <a href="{{ route('home') }}">← Kembali ke Halaman Utama</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
