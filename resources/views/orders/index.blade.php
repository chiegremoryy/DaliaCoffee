<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Order</title>

    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .back-link a {
            text-decoration: none;
            color: #3498db;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .order-table td, .order-table th {
            vertical-align: middle;
        }

        .order-table {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Order</h1>

        <!-- Flash message success -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Card for "Create New Order" -->
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Buat Order Baru</a>
            <a href="{{ route('orders.report') }}" class="btn btn-info">📊 Laporan Penjualan</a>
        </div>

        <!-- Table for orders -->
        <table class="table table-striped table-bordered order-table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Jumlah Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->invoice_code }}</td>
                    <td>{{ $order->order_date->format('d M Y') }}</td>
                    <td>Rp{{ number_format($order->total_amount) }}</td>
                    <td>{{ $order->orderItems->sum('quantity') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-secondary">Print</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Back Link -->
        <div class="back-link text-center mt-3">
            <a href="{{ route('home') }}">← Kembali ke Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
