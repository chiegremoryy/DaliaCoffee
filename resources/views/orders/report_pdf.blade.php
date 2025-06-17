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
            font-size: 12px;
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

        .header-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f1f1f1;
        }

        .total-row td:last-child {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="header-container">
            <h2>Laporan Penjualan</h2>
            <p>Periode: {{ $start }} sampai {{ $end }}</p>
        </div>

        <!-- Sales Report Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Metode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $order->invoice_code }}</td>
                    <td>{{ $order->order_date->format('Y-m-d') }}</td>
                    <td>
                        @foreach($order->orderItems as $item)
                        {{ $item->menu->name }} x{{ $item->quantity }}<br>
                        @endforeach
                    </td>
                    <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Total Penjualan</td>
                    <td colspan="2">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
