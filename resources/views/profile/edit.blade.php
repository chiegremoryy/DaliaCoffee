@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between border-b border-slate-100 pb-5">
        <div class="flex items-center gap-3">
            @if(Auth::user()->role === 'owner')
                <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-primary transition-colors flex items-center">
                    <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
                </a>
            @else
                <a href="{{ route('orders.create') }}" class="text-slate-400 hover:text-primary transition-colors flex items-center">
                    <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
                </a>
            @endif
            <div>
                <h2 class="text-2xl font-bold text-dark font-poppins">Edit Profil</h2>
                <p class="text-xs text-slate-400 mt-0.5">
                    Perbarui data informasi akun Anda
                </p>
            </div>
        </div>
    </div>

    <!-- Visual Avatar Profile Card -->
    <div class="flex flex-col items-center mb-8 bg-slate-50/50 rounded-2xl p-6 border border-slate-100">
        <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-primary to-indigo-400 p-[3px] flex items-center justify-center shadow-lg shadow-primary/10 mb-3 overflow-hidden">
            @if($user->profile_photo)
                <img id="avatar-preview" src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" class="w-full h-full rounded-full object-cover">
            @else
                <div id="avatar-fallback" class="w-full h-full rounded-full bg-white flex items-center justify-center font-extrabold text-primary text-xl tracking-wider">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <img id="avatar-preview" src="" alt="Avatar" class="w-full h-full rounded-full object-cover hidden">
            @endif
        </div>
        <h3 class="text-base font-bold text-dark font-poppins">{{ $user->name }}</h3>
        <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-secondary text-primary mt-1.5 border border-primary/10 tracking-wider uppercase">
            {{ $user->role }}
        </span>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 rounded-xl flex items-center gap-2 text-sm">
            <iconify-icon icon="solar:check-circle-linear" class="text-emerald-600" width="20"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error Validation -->
    @if($errors->any())
        <div class="mb-6 bg-rose-50 text-rose-800 border border-rose-100 px-4 py-3 rounded-xl space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <iconify-icon icon="solar:info-circle-linear" class="text-rose-500" width="16"></iconify-icon>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Foto Profil -->
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Unggah Foto Profil Baru
            </label>
            <div class="relative">
                <input
                    type="file"
                    name="profile_photo"
                    id="profile_photo"
                    accept="image/*"
                    class="hidden"
                    onchange="previewImage(this)">
                <label for="profile_photo" class="flex items-center justify-between w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-500 hover:border-primary/50 cursor-pointer transition-all duration-300">
                    <span id="file-chosen" class="text-sm truncate">Pilih foto profil...</span>
                    <iconify-icon icon="solar:camera-linear" class="text-slate-400" width="20"></iconify-icon>
                </label>
            </div>
            <p class="text-[10px] text-slate-400 mt-1.5">Format: JPG, JPEG, PNG, GIF. Maks: 2MB.</p>
        </div>

        <!-- Nama Lengkap -->
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Nama Lengkap
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <iconify-icon icon="solar:user-linear" width="20"></iconify-icon>
                </span>
                <input
                    type="text"
                    name="name"
                    required
                    value="{{ old('name', $user->name) }}"
                    placeholder="Masukkan nama lengkap"
                    class="w-full h-12 pl-11 pr-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
            </div>
        </div>

        <!-- Alamat Email -->
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Alamat Email
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <iconify-icon icon="solar:letter-linear" width="20"></iconify-icon>
                </span>
                <input
                    type="email"
                    name="email"
                    required
                    value="{{ old('email', $user->email) }}"
                    placeholder="nama@email.com"
                    class="w-full h-12 pl-11 pr-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
            </div>
        </div>

        <div class="border-t border-slate-100 pt-6 mt-6">
            <h4 class="text-xs font-bold text-dark uppercase tracking-wider mb-4">Ganti Password (Kosongkan jika tidak diubah)</h4>
            
            <div class="space-y-4">
                <!-- Password Baru -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                        Password Baru
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <iconify-icon icon="solar:lock-password-linear" width="20"></iconify-icon>
                        </span>
                        <input
                            type="password"
                            name="password"
                            placeholder="Minimal 6 karakter"
                            class="w-full h-12 pl-11 pr-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <iconify-icon icon="solar:lock-keyhole-minimalistic-linear" width="20"></iconify-icon>
                        </span>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full h-12 pl-11 pr-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
                    </div>
                </div>
            </div>
        </div>

        <button
            type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
            <iconify-icon icon="solar:diskette-linear" width="20"></iconify-icon>
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const file = input.files[0];
        const chosenSpan = document.getElementById('file-chosen');
        
        if (file) {
            chosenSpan.textContent = file.name;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview');
                const fallback = document.getElementById('avatar-fallback');
                
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                
                if (fallback) {
                    fallback.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        } else {
            chosenSpan.textContent = 'Pilih foto profil...';
        }
    }
</script>
@endpush
