<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In | Dalia Coffee</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Poppins & Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .title-font {
            font-family: 'Playfair Display', serif;
        }

        .coffee-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234e342e' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .glass-effect {
            background: rgba(255, 248, 240, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#8d6e63] via-[#a1887f] to-[#bcaaa4] flex items-center justify-center p-4 coffee-pattern">

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl">

        <!-- Login Form Section -->
        <div class="glass-effect p-8 sm:p-12 lg:p-16 order-2 lg:order-1">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/dalia-coffee.png') }}" alt="Dalia Coffee Logo" class="max-w-[180px] mx-auto mb-4">
                <h1 class="title-font text-4xl md:text-5xl text-[#3e2723] mb-2">Welcome Back</h1>
                <p class="text-[#6d4c41] text-sm">Sign in to continue your coffee journey</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 animate-pulse">
                <p class="font-medium">{{ $errors->first() }}</p>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="relative">
                    <label for="email" class="block text-[#4e342e] font-medium mb-2 text-sm uppercase tracking-wide">Email Address</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="w-full h-14 pl-12 pr-4 text-base bg-white border-2 border-[#d7ccc8] rounded-xl text-[#3e2723] placeholder-[#a1887f] focus:outline-none focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300"
                            required
                            placeholder="barista@coffee.com">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-[#8d6e63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <label for="password" class="block text-[#4e342e] font-medium mb-2 text-sm uppercase tracking-wide">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full h-14 pl-12 pr-4 text-base bg-white border-2 border-[#d7ccc8] rounded-xl text-[#3e2723] placeholder-[#a1887f] focus:outline-none focus:border-[#6d4c41] focus:ring-4 focus:ring-[#d7ccc8] transition-all duration-300"
                            required
                            placeholder="••••••••">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-[#8d6e63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-[#5d4037] to-[#6d4c41] text-white font-semibold py-4 rounded-xl hover:from-[#4e342e] hover:to-[#5d4037] transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-[#6d4c41] text-sm">Don't have an account?
                    <a href="#" class="text-[#5d4037] font-semibold hover:text-[#4e342e] underline decoration-2 underline-offset-2">Create Account</a>
                </p>
            </div>
        </div>

        <!-- Illustration Section -->
        <div class="bg-gradient-to-br from-[#4e342e] to-[#3e2723] text-white p-8 sm:p-12 lg:p-16 flex flex-col justify-center items-center relative overflow-hidden order-1 lg:order-2">
            <!-- Decorative circles -->
            <div class="absolute top-10 right-10 w-32 h-32 bg-[#6d4c41] rounded-full opacity-20 blur-2xl"></div>
            <div class="absolute bottom-10 left-10 w-40 h-40 bg-[#8d6e63] rounded-full opacity-20 blur-2xl"></div>

            <div class="relative z-10 text-center">
                <img src="{{ asset('images/ilustrasi-kopi.png') }}" alt="Coffee Illustration" class="w-full max-w-sm mx-auto mb-8 drop-shadow-2xl">

                <h2 class="title-font text-3xl md:text-4xl mb-4">Your Daily Dose of Happiness ☕</h2>
                <p class="text-[#bcaaa4] text-lg leading-relaxed max-w-md mx-auto">
                    Every cup tells a story. Sign in to continue yours with premium coffee experiences.
                </p>

                <div class="mt-8 flex justify-center gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-full px-6 py-2">
                        <span class="text-sm font-medium">Premium Quality</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-full px-6 py-2">
                        <span class="text-sm font-medium">Fresh Roasted</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html