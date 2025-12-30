<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-sm">

    <div class="container mx-auto p-6">

        <!-- Header -->
        <div class="bg-orange-50 rounded-2xl shadow p-6 text-center mb-8">
            <h2 class="text-2xl font-bold text-orange-800 mb-1">Laporan Penjualan</h2>
            <p class="text-orange-700">Periode: {{ $start }} sampai {{ $end }}</p>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow border border-gray-300">
                <thead class="bg-orange-100 text-orange-800 font-semibold border-b border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left border-r border-gray-300">No</th>
                        <th class="px-4 py-3 text-left border-r border-gray-300">Invoice</th>
                        <th class="px-4 py-3 text-left border-r border-gray-300">Tanggal</th>
                        <th class="px-4 py-3 text-left border-r border-gray-300">Item</th>
                        <th class="px-4 py-3 text-left border-r border-gray-300">Total</th>
                        <th class="px-4 py-3 text-left">Metode</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($orders as $i => $order)
                    <tr class="hover:bg-orange-50">
                        <td class="px-4 py-3 border-r border-gray-300">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 border-r border-gray-300">{{ $order->invoice_code }}</td>
                        <td class="px-4 py-3 border-r border-gray-300">{{ $order->order_date->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 border-r border-gray-300">
                            @foreach($order->orderItems as $item)
                            {{ $item->menu->name }} x{{ $item->quantity }}<br>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 border-r border-gray-300">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ ucfirst($order->payment_method) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-orange-200 font-bold border-t border-gray-300">
                        <td colspan="4" class="px-4 py-3 border-r border-gray-300">Total Penjualan</td>
                        <td colspan="2" class="px-4 py-3 text-lg">Rp{{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>
