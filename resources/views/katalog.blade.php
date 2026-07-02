<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/dalia-coffee.png') }}">

    <!-- Primary Meta Tags -->
    <title>Katalog Menu | Dalia Coffee</title>
    <meta name="title" content="Katalog Menu | Dalia Coffee">
    <meta name="description" content="Kedai Dalia (Dalia Coffee) menyajikan pilihan kopi premium dengan cita rasa terbaik, makanan lezat, dan suasana yang hangat. Lihat katalog menu kami di sini!">
    <meta name="keywords" content="dalia coffee, kedai dalia, kopi premium, katalog menu dalia">
    <meta name="author" content="Kedai Dalia">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Dalia Coffee - Nikmati Cita Rasa Kopi Terbaik">
    <meta property="og:description" content="Kedai Dalia (Dalia Coffee) menyajikan pilihan kopi premium dengan cita rasa terbaik, makanan lezat, dan suasana yang hangat. Lihat katalog menu kami di sini!">
    <meta property="og:image" content="{{ asset('images/dalia-coffee.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Dalia Coffee - Nikmati Cita Rasa Kopi Terbaik">
    <meta property="twitter:description" content="Kedai Dalia (Dalia Coffee) menyajikan pilihan kopi premium dengan cita rasa terbaik, makanan lezat, dan suasana yang hangat. Lihat katalog menu kami di sini!">
    <meta property="twitter:image" content="{{ asset('images/dalia-coffee.png') }}">

    <!-- Fonts: Montserrat, Playfair Display, Poppins & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Iconify -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>

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
                        sans: ['Plus Jakarta Sans', 'Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Smooth Scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Custom Scrollbar & Hide scrollbar helpers */
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

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#fcfbfc] text-slate-800 font-sans antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 glass border-b border-slate-100/50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo Area -->
            <a href="/" class="flex items-center transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/dalia-coffee.png') }}" alt="Dalia Coffee Logo"
                    class="h-12 w-auto object-contain" />
            </a>

            <!-- Action Button -->
            <div>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
                        <iconify-icon icon="solar:widget-5-linear" width="18"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:shadow-sm hover:border-primary/30 hover:text-primary transition-all duration-300">
                        <iconify-icon icon="solar:login-3-linear" width="18"></iconify-icon>
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sticky Horizontally Scrollable Category Bar -->
    <div class="sticky top-20 z-40 glass border-b border-slate-100/60 py-3.5 shadow-[0_2px_15px_-4px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex gap-2.5 overflow-x-auto no-scrollbar scroll-smooth">
                @foreach ($categories as $category)
                    <button onclick="scrollToCategory('cat-{{ $category->id }}', this)"
                        class="cat-pill whitespace-nowrap px-5 py-2.5 bg-slate-50 border border-slate-100/70 rounded-xl text-[10px] font-bold uppercase tracking-widest text-slate-500 transition-all active:scale-95 duration-200">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menu Sections Container -->
    <main id="menu-section-container" class="max-w-7xl mx-auto px-6 py-12 scroll-mt-36 min-h-[400px]">

        @foreach ($categories as $category)
            @php
                $categoryMenus = $menus->where('category_id', $category->id);
            @endphp
            <div id="cat-{{ $category->id }}" class="category-section mb-16 scroll-mt-40">
                <!-- Category Title Divider -->
                <div class="flex items-center gap-4 mb-8">
                    <h2
                        class="font-extrabold uppercase italic text-xs md:text-sm tracking-widest text-dark flex items-center gap-2">
                        <span class="w-1.5 h-3.5 bg-primary rounded-full block"></span>
                        {{ $category->name }}
                    </h2>
                    <div class="h-[1.5px] flex-1 bg-gradient-to-r from-slate-200 via-slate-100 to-transparent"></div>
                </div>

                @if ($categoryMenus->count() > 0)
                    <!-- Menu Grid (2 Columns Mobile, 3 Tablet, 4 Desktop) -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        @foreach ($categoryMenus as $menu)
                            <div class="menu-card-wrapper" data-name="{{ $menu->name }}"
                                data-category-id="{{ $menu->category_id }}">
                                <div
                                    class="group relative bg-white rounded-[2rem] border border-slate-100/80 p-2 shadow-sm hover:shadow-[0_12px_30px_-6px_rgba(88,2,247,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">

                                    <!-- Image / Thumbnail Container -->
                                    <div class="relative h-40 sm:h-44 md:h-48 w-full rounded-[1.6rem] overflow-hidden bg-slate-50">
                                        @if ($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                        @endif
                                        @if (!$menu->image)
                                            <div
                                                class="w-full h-full bg-gradient-to-tr from-pastelPurple to-indigo-50 flex items-center justify-center">
                                                <iconify-icon icon="solar:coffee-cup-linear" width="40"
                                                    class="text-primary/30"></iconify-icon>
                                            </div>
                                        @endif

                                        <!-- Overlay Tag / Action Indicator -->
                                        <div
                                            class="absolute bottom-3 right-3 bg-dark text-white hover:bg-primary w-8 h-8 rounded-xl flex items-center justify-center font-bold shadow-xl transition-all duration-300 group-hover:scale-110">
                                            <iconify-icon icon="solar:add-circle-bold" class="text-[#fcfbfc] bg-transparent"
                                                width="20"></iconify-icon>
                                        </div>
                                    </div>

                                    <!-- Content Area -->
                                    <div class="p-3 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h3
                                                class="font-bold text-xs md:text-sm text-slate-800 line-clamp-2 leading-tight uppercase mb-1 px-1 group-hover:text-primary transition-colors duration-200">
                                                {{ $menu->name }}
                                            </h3>
                                            <p
                                                class="text-[10px] md:text-xs text-slate-400 font-light line-clamp-2 px-1 mb-3 leading-relaxed">
                                                {{ $menu->description ?? 'Deskripsi menu belum tersedia untuk saat ini.' }}
                                            </p>
                                        </div>

                                        <!-- Price -->
                                        <div class="px-1 flex items-center justify-between border-t border-slate-50 pt-2.5">
                                            <p class="font-extrabold text-xs md:text-sm text-slate-900 italic">
                                                Rp{{ number_format($menu->price, 0, ',', '.') }}
                                            </p>
                                            <span
                                                class="inline-flex items-center text-[8px] md:text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg uppercase tracking-wider">
                                                Active
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State for Empty Category -->
                    <div
                        class="text-center py-10 bg-slate-50/50 border border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center">
                        <iconify-icon icon="solar:tea-cup-broken-linear" width="32" class="text-primary/30 mb-2"></iconify-icon>
                        <p class="text-xs text-slate-400 font-light">Belum ada menu yang tersedia untuk kategori ini.</p>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- No Results Fallback -->
        <div id="no-results"
            class="hidden text-center py-16 space-y-4 bg-white border border-slate-100 rounded-3xl shadow-[0_4px_30px_-10px_rgba(0,0,0,0.02)]">
            <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mx-auto">
                <iconify-icon icon="solar:emoji-funny-sad-linear" width="32"></iconify-icon>
            </div>
            <div class="space-y-1">
                <h3 class="text-dark font-semibold text-lg">Menu Tidak Ditemukan</h3>
                <p class="text-slate-400 text-sm max-w-xs mx-auto">Coba cari dengan kata kunci lain.</p>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 mt-20">
        <!-- Main Footer Info -->
        <div class="max-w-7xl mx-auto px-6 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12">
                <!-- Branding -->
                <div class="md:col-span-5 space-y-4">
                    <img src="{{ asset('images/dalia-coffee.png') }}" alt="Dalia Coffee"
                        class="h-12 w-auto object-contain" />
                    <p class="text-sm text-slate-400 leading-relaxed font-light max-w-sm font-montserrat">
                        Menghadirkan kenyamanan dan keaslian kopi Nusantara ke cangkir Anda setiap hari. Tempat
                        bersantai dan produktif paling pas.
                    </p>
                    <div class="flex gap-3 pt-2">
                        <a href="#"
                            class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary/30 transition-all duration-300">
                            <iconify-icon icon="solar:letter-linear" width="18"></iconify-icon>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary/30 transition-all duration-300">
                            <iconify-icon icon="solar:phone-linear" width="18"></iconify-icon>
                        </a>
                    </div>
                </div>

                <!-- Operating Hours -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-dark font-semibold text-sm uppercase tracking-wider">Jam Operasional</h4>
                    <div class="space-y-3 text-sm text-slate-500 font-light font-montserrat">
                        <div class="flex items-center gap-3">
                            <iconify-icon icon="solar:clock-circle-linear" width="18"
                                class="text-primary"></iconify-icon>
                            <div>
                                <p class="font-medium text-dark">Senin - Minggu</p>
                                <p class="text-xs text-slate-400">18:00 - 24:00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <iconify-icon icon="solar:map-point-linear" width="18" class="text-primary"></iconify-icon>
                            <p class="leading-relaxed">Jl. Raya Tayu - Pati, Pakis Karanganyar, Kec. Tayu, Kabupaten
                                Pati, Jawa Tengah 59155</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="text-dark font-semibold text-sm uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm text-slate-400 font-light font-montserrat">
                        <li>
                            <a href="#menu-section-container" class="hover:text-primary transition-colors">Lihat
                                Menu</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-primary transition-colors">Masuk Staff</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary transition-colors">Kebijakan Privasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="border-t border-slate-50 py-6 bg-slate-50/50">
            <div
                class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-3">
                <p>© {{ date('Y') }} Dalia Coffee. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Filter & Search JS Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const navButtons = document.querySelectorAll('.cat-pill');
            const sections = document.querySelectorAll('.category-section');
            const noResults = document.getElementById('no-results');

            // Scroll helper function
            window.scrollToCategory = (id, button) => {
                const element = document.getElementById(id);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            };

            // IntersectionObserver to dynamically highlight category pills on scroll
            const observerOptions = {
                root: null,
                rootMargin: '-100px 0px -50% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const activeId = entry.target.getAttribute('id');
                        updateActivePill(activeId);
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));

            function updateActivePill(activeId) {
                navButtons.forEach(btn => {
                    const clickAttr = btn.getAttribute('onclick');
                    const targetId = clickAttr.match(/'([^']+)'/)[1];

                    if (targetId === activeId) {
                        btn.classList.add('bg-primary', 'text-white', 'border-primary', 'shadow-md', 'shadow-primary/20');
                        btn.classList.remove('bg-slate-50', 'text-slate-500', 'border-slate-100/70');

                        // Centered horizontal scroll inside mobile navigation container
                        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    } else {
                        btn.classList.remove('bg-primary', 'text-white', 'border-primary', 'shadow-md', 'shadow-primary/20');
                        btn.classList.add('bg-slate-50', 'text-slate-500', 'border-slate-100/70');
                    }
                });
            }

            // Real-time search handler
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                let totalVisible = 0;

                sections.forEach(section => {
                    const cards = section.querySelectorAll('.menu-card-wrapper');
                    let sectionVisibleCount = 0;

                    cards.forEach(card => {
                        const name = card.getAttribute('data-name').toLowerCase();
                        if (name.includes(query)) {
                            card.style.display = 'block';
                            sectionVisibleCount++;
                            totalVisible++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Hide the category section if no menus match the search
                    if (sectionVisibleCount === 0) {
                        section.style.display = 'none';
                    } else {
                        section.style.display = 'block';
                    }
                });

                if (totalVisible === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>