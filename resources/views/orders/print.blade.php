<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->invoice_code }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-stone-100 font-sans text-sm min-h-screen py-8">

    <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-2xl border border-stone-200">

        <!-- Header -->
        <div class="border-b-4 border-stone-800 pb-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="w-16 h-16 bg-black rounded-lg flex items-center justify-center shadow-lg border border-stone-300">
                    <img
                        src="{{ asset('images/dalia-coffee2.png') }}"
                        alt="Dalia Coffee"
                        class="w-12 h-12 object-contain">
                </div>
                <div class="text-right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-1">INVOICE</h2>
                    <p class="text-stone-700 font-semibold text-lg">{{ $order->invoice_code }}</p>
                </div>
            </div>
            <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-2 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">{{ $order->order_date->format('d M Y') }}</span>
            </div>
        </div>

        <!-- Detail Order -->
        <div class="overflow-x-auto mb-8">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-stone-800 to-stone-900 text-white">
                        <th class="px-6 py-4 text-left font-semibold rounded-tl-lg">Nama Item</th>
                        <th class="px-6 py-4 text-center font-semibold">Jumlah</th>
                        <th class="px-6 py-4 text-right font-semibold">Harga</th>
                        <th class="px-6 py-4 text-right font-semibold rounded-tr-lg">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr class="border-b border-gray-200 hover:bg-stone-50 transition-colors duration-150">
                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $item->menu->name }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block bg-stone-100 text-stone-800 px-3 py-1 rounded-full font-semibold">{{ $item->quantity }}</span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-700">Rp{{ number_format($item->menu->price,0,',','.') }}</td>
                        <td class="px-6 py-4 text-right text-gray-800 font-semibold">Rp{{ number_format($item->menu->price * $item->quantity,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="bg-gradient-to-r from-stone-800 to-stone-900 rounded-lg p-6 text-white shadow-lg mb-6">
            <div class="flex justify-between items-center">
                <span class="text-xl font-semibold">Total Pembayaran:</span>
                <span class="text-3xl font-bold">Rp{{ number_format($order->total_amount,0,',','.') }}</span>
            </div>
        </div>

        <!-- Payment Method Section -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-6 border-2 border-gray-200 mb-6">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-gray-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span class="font-semibold text-gray-700">Metode Pembayaran:</span>
            </div>
            <div class="ml-7">
                @if ($order->payment_method === 'qris')
                <span class="inline-flex items-center bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    QRIS (DANA)
                </span>
                @elseif ($order->payment_method === 'cash')
                <span class="inline-flex items-center bg-green-100 text-green-800 px-4 py-2 rounded-lg font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Tunai (Cash)
                </span>
                @else
                <span class="inline-flex items-center bg-gray-100 text-gray-800 px-4 py-2 rounded-lg font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    {{ ucfirst($order->payment_method) }}
                </span>
                @endif
            </div>
        </div>

        <!-- QRIS Section (Only show if QRIS and QR data exists) -->
        @if ($order->payment_method === 'qris' && !empty($qrBase64))
        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border-2 border-blue-200">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-blue-500 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                        </svg>
                    </div>
                    <p class="text-xl font-bold text-blue-900">Scan QRIS DANA</p>
                </div>
                <div class="bg-white p-5 rounded-xl inline-block shadow-lg border-4 border-blue-300">
                    <img src="{{ $qrBase64 }}" alt="QRIS DANA Code" class="w-56 h-56 mx-auto">
                </div>
                <div class="mt-5 bg-blue-100 rounded-lg p-4">
                    <p class="text-sm text-blue-900 font-medium">Buka aplikasi DANA Anda dan scan QR code di atas</p>
                    <p class="text-xs text-blue-700 mt-1">Pastikan nominal pembayaran sesuai dengan total invoice</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-gray-200 text-center text-gray-500 text-xs">
            <p>Terima kasih atas pembelian Anda</p>
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>