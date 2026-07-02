@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">
                Riwayat Transaksi
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                Daftar lengkap riwayat order dan transaksi kasir kedai
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if(Auth::user()->role === 'kasir')
                <a href="{{ route('orders.create') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200">
                    <iconify-icon icon="solar:add-circle-linear" width="20"></iconify-icon>
                    Buat Order
                </a>
            @endif

            <a href="{{ route('orders.report') }}"
               class="inline-flex items-center gap-2 border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold px-5 py-3 rounded-xl transition-all duration-200">
                <iconify-icon icon="solar:chart-square-linear" width="20"></iconify-icon>
                Laporan Penjualan
            </a>
        </div>
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 rounded-xl flex items-center gap-2">
            <iconify-icon icon="solar:check-circle-linear" class="text-emerald-600" width="20"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100 mb-4">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                <tr>
                    <th class="px-6 py-4 text-left">Kode Invoice</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-right">Total Belanja</th>
                    <th class="px-6 py-4 text-center">Jumlah Item</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4 text-left font-mono font-medium text-slate-600">{{ $order->invoice_code }}</td>
                    <td class="px-6 py-4 text-left text-slate-500">{{ $order->order_date->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right font-bold text-dark">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center text-slate-600">{{ $order->orderItems->sum('quantity') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn-action-premium btn-view-premium" title="Detail Order">
                                <iconify-icon icon="solar:eye-linear" width="18"></iconify-icon>
                            </a>
                            <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn-action-premium btn-print-premium" title="Cetak Receipt">
                                <iconify-icon icon="solar:printer-linear" width="18"></iconify-icon>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400 font-medium">Belum ada transaksi order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARDS -->
    <div class="sm:hidden space-y-4 mb-4">
        @forelse($orders as $order)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div class="font-mono font-semibold text-dark">{{ $order->invoice_code }}</div>
                <div class="text-xs text-slate-400">{{ $order->order_date->format('d M Y') }}</div>
            </div>
            <div class="mt-2 text-xs space-y-1 text-slate-500 border-t border-slate-50 pt-2">
                <div>Jumlah Item: <span class="font-medium text-dark">{{ $order->orderItems->sum('quantity') }} item</span></div>
                <div>Total Belanja: <span class="font-bold text-primary">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></div>
            </div>

            <div class="flex justify-end gap-3 mt-3 pt-2.5 border-t border-slate-50">
                <a href="{{ route('orders.show', $order->id) }}" class="btn-action-premium btn-view-premium">
                    <iconify-icon icon="solar:eye-linear" width="18"></iconify-icon>
                </a>
                <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn-action-premium btn-print-premium">
                    <iconify-icon icon="solar:printer-linear" width="18"></iconify-icon>
                </a>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8">Belum ada transaksi order.</div>
        @endforelse
    </div>

    <div>
        {{ $orders->links() }}
    </div>
</div>

<!-- STYLE -->
<style>
.btn-action-premium {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.2s ease;
}
.btn-view-premium {
    background: #eef2ff;
    color: #4f46e5;
}
.btn-view-premium:hover {
    background: #e0e7ff;
    transform: scale(1.05);
}
.btn-print-premium {
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
}
.btn-print-premium:hover {
    background: #f1f5f9;
    transform: scale(1.05);
}
</style>
@endsection
