<h1>Detail Order: {{ $order->invoice_code }}</h1>
<p>Tanggal: {{ $order->order_date->format('d M Y') }}</p>

<table border="1">
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

<p><strong>Total:</strong> Rp{{ number_format($order->total_amount) }}</p>
<a href="{{ route('orders.index') }}">Kembali</a>