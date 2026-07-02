<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst(Auth::user()->role) }} | Dalia Coffee</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/dalia-coffee.png') }}">

    <!-- Fonts: Montserrat (Sans) & Playfair Display (Serif) & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Iconify -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5802f7',
                        secondary: '#f3f0ff',
                        dark: '#1a1a1a',
                        pastelBlue: '#eef2ff',
                        pastelPurple: '#f5f3ff',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'Montserrat', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Chart Tooltip Customization */
        #chartjs-tooltip {
            opacity: 1;
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 8px;
            pointer-events: none;
            transform: translate(-50%, 0);
            transition: all .1s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
    </style>
</head>

<body class="bg-[#fcfbfc] text-slate-600 font-sans antialiased overflow-x-hidden">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar-transition fixed inset-y-0 left-0 z-50 w-64 bg-white/95 backdrop-blur-xl border-r border-slate-100 transform -translate-x-full md:relative md:translate-x-0 flex flex-col justify-between shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
            <!-- Logo Area -->
            <div class="h-20 flex items-center justify-center px-6 border-b border-slate-100">
                <a href="/" class="flex items-center justify-center transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('images/dalia-coffee.png') }}" alt="Dalia Coffee"
                        class="h-12 w-auto object-contain">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                @if(Auth::user()->role === 'owner')
                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Ikhtisar</p>

                    <a href="{{ route('dashboard') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('dashboard') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:widget-5-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('orders.report') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('orders.report') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:chart-square-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Laporan Penjualan</span>
                    </a>

                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Manajemen Toko
                    </p>

                    <a href="{{ route('karyawan.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('karyawan.*') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:users-group-rounded-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Kelola Karyawan</span>
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('categories.*') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:folder-open-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Kelola Kategori</span>
                    </a>

                    <a href="{{ route('menu.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('menu.*') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:box-minimalistic-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Kelola Menu</span>
                    </a>

                    <a href="{{ route('ingredients.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('ingredients.*') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:leaf-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Kelola Bahan Baku</span>
                    </a>

                    <a href="{{ route('stocks.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('stocks.*') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:archive-minimalistic-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Kelola Stok Bahan</span>
                    </a>
                @elseif(Auth::user()->role === 'kasir')
                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kasir Menu</p>

                    <a href="{{ route('orders.create') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('orders.create') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:add-circle-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Tambah Order</span>
                    </a>

                    <a href="{{ route('orders.index') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('orders.index') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:wallet-money-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Riwayat Orders</span>
                    </a>

                    <a href="{{ route('orders.report') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ Route::is('orders.report') ? 'bg-secondary text-primary font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                        <iconify-icon icon="solar:chart-square-linear" width="20" stroke-width="1.5"></iconify-icon>
                        <span>Laporan Penjualan</span>
                    </a>
                @endif
            </nav>

            <!-- Bottom Actions -->
            <div class="p-4 border-t border-slate-50">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-rose-50 hover:text-rose-500 transition-all duration-200 mt-1">
                    <iconify-icon icon="solar:logout-2-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Overlay for Mobile -->
        <div id="sidebar-overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-dark/20 backdrop-blur-sm z-40 hidden md:hidden transition-opacity opacity-0"></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col relative overflow-y-auto overflow-x-hidden scroll-smooth">

            <!-- Header -->
            <header
                class="sticky flex glass md:px-10 md:pt-3 md:pb-3 h-20 z-30 pt-3 pr-6 pb-3 pl-6 top-0 items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                        class="md:hidden text-slate-500 hover:text-primary transition-colors p-1">
                        <iconify-icon icon="solar:hamburger-menu-linear" width="24" stroke-width="1.5"></iconify-icon>
                    </button>
                    <!-- Breadcrumbs -->
                    <nav class="hidden sm:flex items-center text-sm font-medium text-slate-400">
                        <span class="hover:text-primary cursor-pointer transition-colors">Dalia Coffee</span>
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-2 text-xs"></iconify-icon>
                        <span class="text-primarycapitalize">
                            @if(Route::is('dashboard'))
                                Dashboard
                            @elseif(Route::is('karyawan.*'))
                                Karyawan
                            @elseif(Route::is('categories.*'))
                                Kategori
                            @elseif(Route::is('menu.*'))
                                Menu
                            @elseif(Route::is('ingredients.*'))
                                Bahan Baku
                            @elseif(Route::is('stocks.*'))
                                Stok Bahan
                            @elseif(Route::is('orders.report'))
                                Laporan Penjualan
                            @elseif(Route::is('orders.create'))
                                Tambah Order
                            @elseif(Route::is('orders.index'))
                                Riwayat Orders
                            @elseif(Route::is('profile.edit'))
                                Edit Profil
                            @else
                                {{ Request::segment(1) }}
                            @endif
                        </span>
                    </nav>
                </div>

                <div class="flex items-center gap-4 md:gap-6">
                    <!-- Profile Details -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 pl-4 border-l border-slate-200 cursor-pointer group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-semibold text-dark group-hover:text-primary transition-colors">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-indigo-400 p-[2px] flex items-center justify-center overflow-hidden">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Avatar"
                                    class="w-full h-full rounded-full object-cover">
                            @else
                                <div
                                    class="w-full h-full rounded-full bg-white flex items-center justify-center font-bold text-primary text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            </header>

            <!-- Content Container -->
            <div class="md:p-10 w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 pl-6">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer
                class="mt-auto px-6 md:px-10 py-6 border-t border-slate-100 bg-white flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400">
                <p>© {{ date('Y') }} Dalia Coffee. Semua hak cipta dilindungi.</p>
                <div class="flex gap-4 mt-2 sm:mt-0">
                    <span class="hover:text-primary">Panel Admin Premium</span>
                </div>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // --- Sidebar Logic ---
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');

            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                }, 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }
    </script>
    @stack('scripts')
</body>

</html>