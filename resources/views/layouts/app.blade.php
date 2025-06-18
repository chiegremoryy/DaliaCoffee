<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ ucfirst(Auth::user()->role) }} Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            position: sticky;
            top: 0;
            background-color: #4e342e;
        }

        .nav-link {
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }

        .nav-link:hover {
            background-color: #343a40;
        }

        .nav-link.active {
            background-color: #ffffff;
            color: #000 !important;
            font-weight: 600;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 16px;
            right: 16px;
        }

        .main-content {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar text-white p-4">
            <h4 class="mt-2 mb-3">{{ ucfirst(Auth::user()->role) }} Dashboard</h4>

            <hr class="text-secondary mb-5">

            
            <!-- Menu berdasarkan role -->
            <ul class="nav flex-column gap-2">
                @if(Auth::user()->role === 'owner')
                    <li class="nav-item">
                        <a href="{{ route('menu.index') }}" class="nav-link text-white {{ Route::is('menu.index') ? 'active' : '' }}">📋 Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link text-white {{ Route::is('categories.index') ? 'active' : '' }}">📂 Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ingredients.index') }}" class="nav-link text-white {{ Route::is('ingredients.index') ? 'active' : '' }}">🥬 Bahan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stocks.index') }}" class="nav-link text-white {{ Route::is('stocks.index') ? 'active' : '' }}">📦 Stok</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('karyawan.index') }}" class="nav-link text-white {{ Route::is('karyawan.index') ? 'active' : '' }}">👥 Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.report') }}" class="nav-link text-white {{ Route::is('orders.report') ? 'active' : '' }}">📈 Laporan</a>
                    </li>
                @elseif(Auth::user()->role === 'kasir')
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link text-white {{ Route::is('orders.index') ? 'active' : '' }}">💵 Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.history') }}" class="nav-link text-white {{ Route::is('orders.history') ? 'active' : '' }}">🧾 Riwayat</a>
                    </li>
                @endif
            </ul>

            <!-- Logout -->
            <div class="logout-btn">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light w-100">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="p-4 flex-grow-1 main-content">
            @yield('content')
        </main>
    </div>
    @stack('scripts')   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
