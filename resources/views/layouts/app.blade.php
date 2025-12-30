<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst(Auth::user()->role) }} Panel | Dalia Coffee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4]">

<div x-data="{ open: false }" class="flex min-h-screen">

    <!-- OVERLAY MOBILE -->
    <div x-show="open"
         @click="open=false"
         class="fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

    <!-- SIDEBAR -->
    <aside
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed lg:static z-50
               w-64 min-h-screen
               bg-[#4e342e] text-[#fff8f0]
               px-6 py-8 shadow-xl
               transition-transform duration-300
               lg:translate-x-0">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/dalia-coffee2.png') }}"
                 class="mx-auto max-w-[150px]" alt="Dalia Coffee">
        </div>

        <h2 class="text-lg font-semibold mb-6 text-center">
            {{ ucfirst(Auth::user()->role) }} Dashboard
        </h2>

        <!-- MENU -->
        <nav class="flex-1 space-y-2">

            @if(Auth::user()->role === 'owner')

            <a href="{{ route('karyawan.index') }}"
               class="sidebar-link {{ Route::is('karyawan.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Karyawan</span>
            </a>

            <a href="{{ route('categories.index') }}"
               class="sidebar-link {{ Route::is('categories.*') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('menu.index') }}" class="sidebar-link">
                <i class="fas fa-utensils"></i>
                <span>Menu</span>
            </a>

            <a href="{{ route('ingredients.index') }}" class="sidebar-link">
                <i class="fas fa-leaf"></i>
                <span>Bahan</span>
            </a>

            <a href="{{ route('stocks.index') }}" class="sidebar-link">
                <i class="fas fa-boxes-stacked"></i>
                <span>Stok</span>
            </a>

            <a href="{{ route('orders.report') }}" class="sidebar-link">
                <i class="fas fa-chart-line"></i>
                <span>Laporan</span>
            </a>

            @endif
        </nav>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button
                class="w-full py-2 rounded-lg border border-[#fff8f0]
                       hover:bg-[#fff8f0] hover:text-[#4e342e]
                       transition font-semibold">
                Logout
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 w-full">

        <!-- TOPBAR MOBILE -->
        <div class="lg:hidden flex items-center justify-between p-4 bg-[#4e342e] text-white">
            <button @click="open=true">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="font-semibold">Dalia Coffee</span>
        </div>

        <!-- CONTENT -->
        <div class="p-4 sm:p-6 lg:p-10">
            @yield('content')
        </div>
    </main>

</div>

<style>
.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 12px;
    font-weight: 500;
    transition: all .2s ease;
}
.sidebar-link:hover { background-color: #6d4c41; }
.sidebar-link.active {
    background-color: #fff8f0;
    color: #4e342e;
    font-weight: 600;
}
</style>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stack('scripts')
</body>
</html>
