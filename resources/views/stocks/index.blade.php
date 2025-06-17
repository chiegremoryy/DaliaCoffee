<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Stok</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            text-align: center;
        }
        .action-buttons button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #c0392b;
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
        <!-- Page Title and Links -->
        <h1>Riwayat Stok</h1>

        <div class="mb-4">
            <a href="{{ route('stocks.create') }}" class="btn btn-success">+ Tambah Transaksi</a>
            <a href="{{ route('ingredients.index') }}" class="btn btn-info">Lihat Daftar Bahan Baku</a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Transaction History Table -->
        <h3 class="mt-4">Riwayat Transaksi Stok</h3>
        <table class="table table-bordered table-striped">
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
                        <td class="action-buttons">
                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus histori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Stock Table -->
        <h3 class="mt-4">Total Stok Saat Ini</h3>
        <table class="table table-bordered table-striped">
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
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
