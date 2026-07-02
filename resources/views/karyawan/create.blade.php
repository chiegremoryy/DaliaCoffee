@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('karyawan.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Tambah Karyawan</h2>
        </div>
        <p class="text-sm text-slate-400">
            Tambahkan akun karyawan baru untuk kasir kedai
        </p>
    </div>

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
    <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Nama Lengkap
            </label>
            <input
                type="text"
                name="name"
                required
                value="{{ old('name') }}"
                placeholder="Masukkan nama lengkap"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Alamat Email
            </label>
            <input
                type="email"
                name="email"
                required
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                Kata Sandi (Password)
            </label>
            <input
                type="password"
                name="password"
                required
                placeholder="Minimal 6 karakter"
                class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark placeholder-slate-400 focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all duration-300">
        </div>

        <button
            type="submit"
            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
            Simpan Karyawan
        </button>
    </form>

</div>
@endsection
