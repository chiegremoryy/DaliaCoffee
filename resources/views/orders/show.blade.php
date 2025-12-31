<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order: {{ $order->invoice_code }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 248, 240, 0.95);
            backdrop-filter: blur(10px);
        }

        .coffee-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234e342e' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4] coffee-pattern p-6">

    <div class="max-w-4xl mx-auto glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#3e2723] mb-2">
                Detail Order: {{ $order->invoice_code }}
            </h1>
        </div>

        <!-- Info Order -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <div class="bg-white rounded-xl p-4 border">
                <p class="text-xs text-[#6d4c41]">Tanggal Order</p>
                <p class="font-semibold text-[#3e2723]">
                    {{ $order->order_date->format('d M Y') }}
                </p>
            </div>

            <div class="bg-white rounded-xl p-4 border">
                <p class="text-xs text-[#6d4c41]">Metode Pembayaran</p>
                <p class="font-semibold">
                    <span class="inline-block px-3 py-1 rounded-full text-xs
                        bg-[#d7ccc8] text-[#4e342e]">
                        {{ $order->payment_method ?? '-' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full text-left border border-[#d7ccc8] rounded-xl overflow-hidden">
                <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3">Menu</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#d7ccc8] text-[#3e2723]">
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->menu->name }}</td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3">
                            Rp{{ number_format($item->price_per_item,0,',','.') }}
                        </td>
                        <td class="px-4 py-3">
                            Rp{{ number_format($item->subtotal,0,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-[#efebe9] text-[#3e2723] font-semibold text-sm">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right">Total</td>
                        <td class="px-4 py-3">
                            Rp{{ number_format($order->total_amount,0,',','.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="sm:hidden space-y-4">
            @foreach($order->orderItems as $item)
            <div class="bg-white rounded-xl border p-4 shadow-sm">
                <div class="font-semibold text-[#3e2723]">
                    {{ $item->menu->name }}
                </div>
                <div class="text-sm text-[#6d4c41] mt-1">
                    Jumlah: {{ $item->quantity }}
                </div>
                <div class="text-sm mt-1">
                    Harga: Rp{{ number_format($item->price_per_item,0,',','.') }}
                </div>
                <div class="text-sm mt-1 font-semibold">
                    Subtotal: Rp{{ number_format($item->subtotal,0,',','.') }}
                </div>
            </div>
            @endforeach

            <!-- Total -->
            <div class="bg-[#efebe9] rounded-xl p-4 text-right font-semibold text-[#3e2723]">
                Total: Rp{{ number_format($order->total_amount,0,',','.') }}
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('orders.index') }}"
                class="inline-block px-6 py-3 bg-[#efebe9] text-[#4e342e] font-semibold rounded-xl
                      hover:bg-[#e0d6d1] transition-all">
                Back
            </a>
        </div>

    </div>

</body>

</html>