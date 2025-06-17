<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .filter-form input, .filter-form button {
            margin-right: 10px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Laporan Penjualan</h1>

        <!-- Filter Form -->
        <div class="form-container">
            <form method="GET" action="{{ route('orders.report') }}" class="d-flex justify-content-start">
                <div class="form-group me-3">
                    <label for="from" class="form-label">Dari Tanggal:</label>
                    <input type="date" name="from" id="from" value="{{ request('from') }}" class="form-control">
                </div>
                <div class="form-group me-3">
                    <label for="to" class="form-label">Sampai Tanggal:</label>
                    <input type="date" name="to" id="to" value="{{ request('to') }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <!-- Export PDF Button -->
        <div class="mb-3">
            <a href="{{ route('orders.export.pdf', request()->only('from', 'to')) }}" target="_blank" class="btn btn-danger">Export PDF</a>
        </div>

        <!-- Sales Report Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Metode</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->invoice_code }}</td>
                    <td>{{ $order->order_date->format('d-m-Y') }}</td>
                    <td>Rp{{ number_format($order->total_amount) }}</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Back Link -->
        <div class="back-link text-center mt-3">
            <a href="{{ route('orders.index') }}">← Kembali</a>
        </div>

    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
