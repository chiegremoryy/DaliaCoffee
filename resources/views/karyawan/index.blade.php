<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan/Kasir</title>
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

        .table td, .table th {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .action-btns a, .action-btns button {
            margin-right: 10px;
        }

        .action-btns button {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }

        .action-btns button:hover {
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

    <div class="container">
        <h1>Daftar Karyawan/Kasir</h1>

        <!-- Add Employee Button -->
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>

        <!-- Employee Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="action-btns">
                            <!-- Edit Button -->
                            <a href="{{ route('karyawan.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
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
