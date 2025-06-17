<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ingredient</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        .card {
            border-radius: 15px;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card-body {
            padding: 2rem;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .form-control {
            height: 50px;
            font-size: 16px;
        }

        .btn-primary {
            font-size: 16px;
            padding: 12px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
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

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="text-center">Tambah Bahan Baku</h1>

                <!-- Form for Adding Ingredient -->
                <form action="{{ route('ingredients.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Bahan</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="unit" class="form-label">Satuan</label>
                        <input type="text" name="unit" id="unit" class="form-control" placeholder="misal: gr, butir, bungkus" required>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Awal</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>

                <!-- Back to Ingredients List Link -->
                <div class="back-link">
                    <a href="{{ route('ingredients.index') }}">← Kembali ke daftar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
