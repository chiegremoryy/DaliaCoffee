<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Masuk</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control, .form-select, textarea {
            height: 50px;
            font-size: 16px;
        }
        .form-label {
            font-weight: bold;
        }
        .back-link a {
            text-decoration: none;
            color: #3498db;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        .error-list {
            color: red;
        }
        .error-list li {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Card Wrapper for the Form -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1>Tambah Stok Masuk</h1>
            </div>
            <div class="card-body">
                <!-- Display Errors -->
                @if ($errors->any())
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <!-- Stock In Form -->
                <form method="POST" action="{{ route('stocks.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="ingredientSelect" class="form-label">Bahan</label>
                        <select name="ingredient_id" id="ingredientSelect" class="form-select" onchange="updateStockInfo()">
                            <option value="">-- Pilih Bahan --</option>
                            @foreach ($ingredients as $ing)
                                <option 
                                    value="{{ $ing->id }}"
                                    data-stock="{{ $ing->stock }}"
                                    data-unit="{{ $ing->unit }}"
                                >
                                    {{ $ing->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stock Info -->
                    <div id="stockInfo" class="mb-3" style="display: none;">
                        <strong>Stok Saat Ini:</strong> <span id="stockValue"></span>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah Tambahan</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                    </div>

                    <input type="hidden" name="type" value="in">

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (opsional)</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Back Link -->
        <div class="back-link mt-3 text-center">
            <a href="{{ route('stocks.index') }}">← Kembali</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStockInfo() {
            const select = document.getElementById('ingredientSelect');
            const selectedOption = select.options[select.selectedIndex];

            const stock = selectedOption.getAttribute('data-stock');
            const unit = selectedOption.getAttribute('data-unit');

            if (stock && unit) {
                document.getElementById('stockValue').innerText = `${stock} ${unit}`;
                document.getElementById('stockInfo').style.display = 'block';
            } else {
                document.getElementById('stockInfo').style.display = 'none';
            }
        }
    </script>
</body>
</html>
