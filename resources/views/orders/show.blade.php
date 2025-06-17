<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order: {{ $order->invoice_code }}</title>

    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
        }

        .table th, .table td {
            text-align: left;
            padding: 10px;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table tfoot {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 20px;
        }

        .invoice-info {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">Detail Order: {{ $order->invoice_code }}</h1>

        <!-- Invoice Information -->
        <div class="invoice-info text-center mb-4">
            <p><strong>Tanggal:</strong> {{ $order->order_date->format('d M Y') }}</p>
        </div>

        <!-- Order Items Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price_per_item) }}</td>
                    <td>Rp{{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Amount -->
        <div class="total text-end">
            <p><strong>Total:</strong> Rp{{ number_format($order->total_amount) }}</p>
        </div>

        <!-- Back Link -->
        <div class="back-link text-center mt-3">
            <a href="{{ route('orders.index') }}">← Kembali ke Daftar Order</a>
        </div>

    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
