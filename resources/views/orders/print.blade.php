{{-- print invoice --}}
<body onload="window.print()">
    @include('orders.show', ['order' => $order])

    @if ($order->payment_method === 'qris' && !empty($qrBase64))
        <div style="text-align: center; margin-top: 20px;">
            <p><strong>Scan QRIS untuk pembayaran:</strong></p>
            <img src="{{ $qrBase64 }}" alt="QRIS Code" style="width: 200px; height: 200px;">
        </div>
    @endif

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('orders.create') }}">Kembali</a>
    </div>
</body>
