@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Stok Bahan
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Riwayat transaksi & total stok bahan baku
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="{{ route('stocks.create') }}"
                class="inline-flex items-center gap-2 bg-[#5d4037] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
                <i class="fas fa-plus"></i> Tambah Stok
            </a>

            <a href="{{ route('ingredients.index') }}"
                class="inline-flex items-center gap-2 bg-[#8d6e63] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#6d4c41] transition">
                <i class="fas fa-list"></i> Bahan Baku
            </a>
        </div>
    </div>

    <!-- ALERT -->
    @if (session('success'))
    <div class="mb-6 rounded-xl bg-green-100 text-green-800 px-5 py-3">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- ===================== -->
    <!-- RIWAYAT TRANSAKSI -->
    <!-- ===================== -->
    <h3 class="text-lg font-semibold text-[#3e2723] mb-3">
        Riwayat Transaksi Stok
    </h3>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8] mb-4">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Bahan</th>
                    <th class="px-6 py-4 text-center">Jumlah</th>
                    <th class="px-6 py-4 text-center">Jenis</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-center w-20">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse ($stocks as $stock)
                <tr>
                    <td class="px-6 py-4">{{ $stock->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $stock->ingredient->name }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $stock->quantity }} {{ $stock->ingredient->unit }}</td>
                    <td class="px-6 py-4 text-center capitalize">{{ $stock->type }}</td>
                    <td class="px-6 py-4">{{ $stock->description ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center">
                            <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                                @csrf @method('DELETE')
                                <button class="btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-[#6d4c41]">Belum ada transaksi stok</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4 mb-4">
        @forelse ($stocks as $stock)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">{{ $stock->ingredient->name }}</div>
            <div class="text-sm text-[#6d4c41] mt-2 space-y-1">
                <div>Tanggal: {{ $stock->created_at->format('d-m-Y H:i') }}</div>
                <div>Jumlah: <span class="font-semibold">{{ $stock->quantity }} {{ $stock->ingredient->unit }}</span></div>
                <div>Jenis: {{ ucfirst($stock->type) }}</div>
                <div>Ket: {{ $stock->description ?? '-' }}</div>
            </div>
            <div class="flex justify-end mt-4">
                <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                    @csrf @method('DELETE')
                    <button class="btn-delete"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-[#6d4c41] py-6">Belum ada transaksi stok</div>
        @endforelse
    </div>

    <!-- PAGINATION RIWAYAT STOK -->
    <div class="mt-4">
        {{ $stocks->links('pagination::tailwind') }}
    </div>

    <!-- ===================== -->
    <!-- TOTAL STOK -->
    <!-- ===================== -->
    <h3 class="text-lg font-semibold text-[#3e2723] mb-3 mt-6">
        Total Stok Saat Ini
    </h3>

    <div class="overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Bahan</th>
                    <th class="px-6 py-4 text-center w-32">Stok</th>
                    <th class="px-6 py-4 text-center w-32">Satuan</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @foreach ($ingredients as $ingredient)
                <tr>
                    <td class="px-6 py-4">{{ $ingredient->name }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $ingredient->stock }}</td>
                    <td class="px-6 py-4 text-center">{{ $ingredient->unit }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<style>
    .btn-delete {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #ef9a9a;
        color: #b71c1c;
    }
</style>

<script>
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus histori stok?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5d4037'
            }).then(res => {
                if (res.isConfirmed) form.submit();
            });
        });
    });
</script>
@endsection
