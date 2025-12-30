<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->invoice_code }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-sm">

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-6">

        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-orange-800 mb-1">Invoice Order - {{ $order->invoice_code }}</h2>
            <p class="text-orange-700">Tanggal: {{ $order->order_date->format('d M Y') }}</p>
        </div>

        <!-- Detail Order -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                <thead class="bg-orange-100 text-orange-800 font-semibold">
                    <tr>
                        <th class="px-4 py-3 border-r border-gray-300 text-left">Nama Item</th>
                        <th class="px-4 py-3 border-r border-gray-300 text-left">Jumlah</th>
                        <th class="px-4 py-3 border-r border-gray-300 text-left">Harga</th>
                        <th class="px-4 py-3 text-left">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($order->orderItems as $item)
                    <tr class="hover:bg-orange-50">
                        <td class="px-4 py-3 border-r border-gray-300">{{ $item->menu->name }}</td>
                        <td class="px-4 py-3 border-r border-gray-300">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 border-r border-gray-300">Rp{{ number_format($item->menu->price,0,',','.') }}</td>
                        <td class="px-4 py-3">Rp{{ number_format($item->menu->price * $item->quantity,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-orange-200 font-bold border-t border-gray-300">
                        <td colspan="3" class="px-4 py-3 border-r border-gray-300 text-right">Total:</td>
                        <td class="px-4 py-3 text-lg">Rp{{ number_format($order->total_amount,0,',','.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- QRIS Section -->
        @if ($order->payment_method === 'qris' && !empty($qrBase64))
        <div class="mt-6 text-center">
            <p class="font-semibold mb-2">Scan QRIS untuk pembayaran:</p>
            <img src="{{ $qrBase64 }}" alt="QRIS Code" class="w-48 h-48 mx-auto">
        </div>
        @endif

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">Kembali ke Halaman Buat Order Baru</a>
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>
