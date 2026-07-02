@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">
                Stok Bahan Baku
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                Riwayat transaksi masuk/keluar dan pencatatan total stok bahan baku
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('stocks.create') }}"
               class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200">
                <iconify-icon icon="solar:archive-linear" width="20"></iconify-icon>
                Tambah Stok
            </a>

            <a href="{{ route('ingredients.index') }}"
               class="inline-flex items-center gap-2 border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold px-5 py-3 rounded-xl transition-all duration-200">
                <iconify-icon icon="solar:leaf-linear" width="20"></iconify-icon>
                Bahan Baku
            </a>
        </div>
    </div>

    <!-- ALERT SUCCESS -->
    @if (session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 rounded-xl flex items-center gap-2">
            <iconify-icon icon="solar:check-circle-linear" class="text-emerald-600" width="20"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- RIWAYAT TRANSAKSI SECTION -->
    <div class="mb-8 border-b border-slate-100 pb-8">
        <h3 class="text-lg font-semibold text-dark mb-4 font-poppins flex items-center gap-2">
            <iconify-icon icon="solar:history-linear" width="20" class="text-primary"></iconify-icon>
            Riwayat Transaksi Stok
        </h3>

        <!-- DESKTOP TABLE -->
        <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100 mb-4">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Bahan Baku</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-center">Jenis</th>
                        <th class="px-6 py-4 text-left">Keterangan</th>
                        <th class="px-6 py-4 text-center w-20">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($stocks as $stock)
                    <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                        <td class="px-6 py-4 text-slate-500 font-mono">{{ $stock->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-dark">{{ $stock->ingredient->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-center font-bold font-mono text-dark">
                            {{ (float)$stock->quantity }} {{ $stock->ingredient->unit }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                {{ $stock->type === 'in'
                                    ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                                    : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                                {{ $stock->type === 'in' ? 'Masuk' : 'Keluar' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $stock->description ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                                    @csrf @method('DELETE')
                                    <button class="btn-delete-premium">
                                        <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-medium">Belum ada transaksi riwayat stok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- MOBILE CARD -->
        <div class="sm:hidden space-y-4 mb-4">
            @forelse ($stocks as $stock)
            <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
                <div class="flex justify-between items-start">
                    <div class="font-semibold text-dark">{{ $stock->ingredient->name }}</div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold
                        {{ $stock->type === 'in'
                            ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                            : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                        {{ $stock->type === 'in' ? 'Masuk' : 'Keluar' }}
                    </span>
                </div>
                <div class="text-xs text-slate-400 mt-2 space-y-1">
                    <div>Tanggal: <span class="font-mono">{{ $stock->created_at->format('d M Y H:i') }}</span></div>
                    <div>Jumlah: <span class="font-bold text-dark">{{ (float)$stock->quantity }} {{ $stock->ingredient->unit }}</span></div>
                    <div>Keterangan: <span>{{ $stock->description ?? '-' }}</span></div>
                </div>
                <div class="flex justify-end mt-3 border-t border-slate-50 pt-2.5">
                    <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                        @csrf @method('DELETE')
                        <button class="btn-delete-premium">
                            <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-400 py-6">Belum ada transaksi riwayat stok</div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $stocks->links() }}
        </div>
    </div>

    <!-- TOTAL STOK SECTION -->
    <div>
        <h3 class="text-lg font-semibold text-dark mb-4 font-poppins flex items-center gap-2">
            <iconify-icon icon="solar:box-linear" width="20" class="text-primary"></iconify-icon>
            Total Stok Bahan Saat Ini
        </h3>

        <div class="overflow-hidden rounded-2xl border border-slate-100 mb-4">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama Bahan Baku</th>
                        <th class="px-6 py-4 text-center w-48">Total Stok</th>
                        <th class="px-6 py-4 text-center w-48">Satuan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach ($ingredients as $ingredient)
                    <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                        <td class="px-6 py-4">
                            <span class="font-semibold text-dark">{{ $ingredient->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-center font-bold font-mono {{ $ingredient->stock <= 5 ? 'text-rose-600' : 'text-slate-700' }}">
                            {{ (float)$ingredient->stock }}
                        </td>
                        <td class="px-6 py-4 text-center text-slate-500">{{ $ingredient->unit }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $ingredients->links() }}
        </div>
    </div>

</div>

<!-- STYLE -->
<style>
.btn-delete-premium {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #fff0f6;
    color: #e64980;
    transition: all 0.2s ease;
}
.btn-delete-premium:hover {
    background: #ffdeeb;
    transform: scale(1.05);
}
</style>

<!-- SWEETALERT DELETE Confirm -->
<script>
document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        Swal.fire({
            title: 'Batalkan transaksi stok?',
            text: 'Membatalkan histori transaksi stok akan mengembalikan nilai stok ke sebelumnya.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5802f7',
            cancelButtonColor: '#e64980',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(res => {
            if (res.isConfirmed) form.submit();
        });
    });
});
</script>
@endsection
