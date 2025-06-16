<h1>Laporan Penjualan</h1>

<form method="GET" action="{{ route('orders.report') }}">
    <label>Dari Tanggal:</label>
    <input type="date" name="from" value="{{ request('from') }}">
    <label>Sampai Tanggal:</label>
    <input type="date" name="to" value="{{ request('to') }}">
    <button type="submit">Filter</button>
</form>

<br>
<a href="{{ route('orders.export.pdf', request()->only('from', 'to')) }}" target="_blank">Export PDF</a>

<table border="1" cellpadding="5" cellspacing="0">
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
                <td>{{ $order->payment_method }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('orders.index') }}">Kembali</a>