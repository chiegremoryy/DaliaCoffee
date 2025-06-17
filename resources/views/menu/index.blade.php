<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ingredient-item {
            margin-bottom: 10px;
        }
        .form-control, .form-select {
            height: 50px;
            font-size: 16px;
        }
        .ingredient-item select, .ingredient-item input {
            margin-right: 10px;
        }
        .ingredient-item button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .ingredient-item button:hover {
            background-color: #c0392b;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
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
        <!-- Card Wrapper for the Form -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1>Daftar Menu</h1>
            </div>
            <div class="card-body">
                <!-- Add Menu Button -->
                <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Menu Table -->
                <table class="table table-bordered table-hover">
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
                            <td>{{ ucfirst($menu->status) }}</td>
                            <td class="btn-group">
                                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('menu.show', $menu->id) }}" class="btn btn-info btn-sm">More</a>
                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
