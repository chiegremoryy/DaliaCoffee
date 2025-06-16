{{-- print invoice --}}
<body onload="window.print()">
    @include('orders.show', ['order' => $order])
    <a href="{{ route('orders.create') }}">Kembali</a>
</body>
