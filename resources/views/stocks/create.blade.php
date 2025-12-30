<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Masuk | Dalia Coffee</title>

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

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4] coffee-pattern p-6">

    <div class="w-full max-w-xl glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#3e2723] mb-2">
                Tambah Stok Masuk
            </h1>
            <p class="text-sm text-[#6d4c41]">
                Catat penambahan stok bahan baku
            </p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-300 bg-red-50 p-4">
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('stocks.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Bahan
                </label>
                <select
                    name="ingredient_id"
                    id="ingredientSelect"
                    onchange="updateStockInfo()"
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300">
                    <option value="">Pilih Bahan</option>
                    @foreach ($ingredients as $ing)
                        <option
                            value="{{ $ing->id }}"
                            data-stock="{{ $ing->stock }}"
                            data-unit="{{ $ing->unit }}">
                            {{ $ing->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Stock Info -->
            <div id="stockInfo" class="hidden rounded-xl bg-[#efebe9] p-4 text-sm text-[#4e342e]">
                <strong>Stok Saat Ini:</strong>
                <span id="stockValue" class="font-semibold"></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Jumlah Tambahan
                </label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    min="1"
                    required
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300">
            </div>

            <input type="hidden" name="type" value="in">

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Deskripsi (opsional)
                </label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full px-4 py-3 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300"></textarea>
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41]
                       text-white font-semibold py-4 rounded-xl
                       hover:from-[#4e342e] hover:to-[#5d4037]
                       transform hover:scale-[1.02]
                       transition-all duration-300 shadow-lg hover:shadow-xl">
                Simpan Stok
            </button>
        </form>

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('stocks.index') }}"
               class="text-sm font-semibold text-[#5d4037]
                      hover:text-[#4e342e]
                      underline decoration-2 underline-offset-4">
                Back to Stocks List
            </a>
        </div>

    </div>

    <!-- JS Logic (tetap) -->
    <script>
        function updateStockInfo() {
            const select = document.getElementById('ingredientSelect');
            const selectedOption = select.options[select.selectedIndex];

            const stock = selectedOption.getAttribute('data-stock');
            const unit = selectedOption.getAttribute('data-unit');

            const info = document.getElementById('stockInfo');
            const value = document.getElementById('stockValue');

            if (stock && unit) {
                value.innerText = `${stock} ${unit}`;
                info.classList.remove('hidden');
            } else {
                info.classList.add('hidden');
            }
        }
    </script>

</body>
</html>