<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p>Periode: {{ $start }} sampai {{ $end }}</p>

    <table>
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
            <tr>
                <td colspan="4"><strong>Total Penjualan</strong></td>
                <td colspan="2"><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
