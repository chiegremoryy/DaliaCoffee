<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan | Dalia Coffee</title>

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

    <div class="w-full max-w-md glass-effect rounded-3xl shadow-2xl p-8 sm:p-12">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#3e2723] mb-2">
                Tambah Karyawan
            </h1>
            <p class="text-sm text-[#6d4c41]">
                Tambahkan akun karyawan baru
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Nama
                </label>
                <input
                    type="text"
                    name="name"
                    required
                    placeholder="Nama lengkap"
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           placeholder-[#a1887f]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8]
                           transition-all duration-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="email@contoh.com"
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           placeholder-[#a1887f]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8]
                           transition-all duration-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-[#4e342e] uppercase tracking-wide mb-2">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Minimal 8 karakter"
                    class="w-full h-14 px-4 rounded-xl border-2 border-[#d7ccc8] bg-white text-[#3e2723]
                           placeholder-[#a1887f]
                           focus:outline-none focus:border-[#6d4c41]
                           focus:ring-4 focus:ring-[#d7ccc8]
                           transition-all duration-300">
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41]
                       text-white font-semibold py-4 rounded-xl
                       hover:from-[#4e342e] hover:to-[#5d4037]
                       transform hover:scale-[1.02]
                       transition-all duration-300 shadow-lg hover:shadow-xl">
                Simpan Karyawan
            </button>
        </form>

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('karyawan.index') }}"
               class="text-sm font-semibold text-[#5d4037]
                      hover:text-[#4e342e]
                      underline decoration-2 underline-offset-4">
                Back to Karyawan List
            </a>
        </div>

    </div>

</body>
</html>
