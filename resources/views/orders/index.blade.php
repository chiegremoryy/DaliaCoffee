<!DOCTYPE html>
<html>
<head>
    <title>Daftar Order</title>
</head>
<body>
    <a href="{{ route('orders.create') }}">+ Buat Order Baru</a>
    <h1>Riwayat Order</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
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
                        <a href="{{ route('orders.show', $order->id) }}">Detail</a>
                        |
                        <a href="{{ route('orders.print', $order->id) }}" target="_blank">Print</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada order.</td></tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <a href="{{ route('orders.report') }}">📊 Laporan Penjualan</a>
</body>
</html>
