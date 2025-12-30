<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Order Baru | Dalia Coffee</title>

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

    <div class="max-w-3xl mx-auto glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#3e2723] mb-2">Formulir Order Baru</h1>
            <p class="text-sm text-[#6d4c41]">Tambahkan order baru dan pilih menu beserta jumlahnya</p>
        </div>

        <!-- Form Order -->
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6" id="order-form">
            @csrf

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Metode Pembayaran
                </label>
                <select name="payment_method" required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           focus:outline-none focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300">
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <!-- Order Items -->
            <div id="order-items" class="space-y-3">
                <div class="order-item flex flex-col sm:flex-row gap-3 items-center">
                    <select name="items[0][menu_id]" required
                        class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                               focus:outline-none focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">
                                {{ $menu->name }} (Rp{{ number_format($menu->price) }})
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="items[0][quantity]" placeholder="Jumlah" min="1" required
                        class="w-full sm:w-32 h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                               focus:outline-none focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300">

                    <button type="button" onclick="removeItem(this)"
                        class="h-14 px-5 rounded-xl bg-red-100 text-red-600 font-semibold hover:bg-red-200 transition-all">
                        🗑
                    </button>
                </div>
            </div>

            <!-- Add Item Button -->
            <button type="button" onclick="addItem()"
                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#efebe9] text-[#4e342e]
                       font-semibold hover:bg-[#e0d6d1] transition-all">
                + Tambah Item
            </button>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41] text-white font-semibold py-4 rounded-xl
                       hover:from-[#4e342e] hover:to-[#5d4037] transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                Simpan Order
            </button>

        </form>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('orders.index') }}"
               class="text-sm font-semibold text-[#5d4037] hover:text-[#4e342e] underline decoration-2 underline-offset-4">
                Kembali ke Riwayat Transaksi
            </a>
        </div>

    </div>