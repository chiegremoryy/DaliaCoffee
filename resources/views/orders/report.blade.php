@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="mb-8 border-b border-slate-100 pb-6">
        <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">Laporan Penjualan</h2>
        <p class="text-sm text-slate-400 mt-1">Filter, pantau total omset, dan cetak laporan ekspor PDF penjualan</p>
    </div>

    <!-- FILTER FORM -->
    <form method="GET" action="{{ route('orders.report') }}" class="flex flex-col sm:flex-row sm:items-end gap-4 mb-8">
        <div class="flex-1">
            <label for="start_date" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date', $start) }}"
                   class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all text-sm">
        </div>
        <div class="flex-1">
            <label for="end_date" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date', $end) }}"
                   class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all text-sm">
        </div>
        <div class="flex gap-3 flex-wrap">
            <button type="submit"
                    class="h-12 inline-flex items-center justify-center gap-2 bg-primary text-white font-semibold px-5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200 text-sm w-full sm:w-auto">
                <iconify-icon icon="solar:filter-linear" width="18"></iconify-icon>
                Filter
            </button>
            <a href="{{ route('orders.export.pdf', request()->only('start_date','end_date')) }}" target="_blank"
               class="h-12 inline-flex items-center justify-center gap-2 bg-rose-500 text-white font-semibold px-5 rounded-xl shadow-lg shadow-rose-500/20 hover:shadow-rose-500/40 hover:-translate-y-0.5 transition-all duration-200 text-sm w-full sm:w-auto">
                <iconify-icon icon="solar:file-text-linear" width="18"></iconify-icon>
                Ekspor PDF
            </a>
        </div>
    </form>

    <!-- METRICS SUMMARY (Real info!) -->
    <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4 mb-8 flex justify-between items-center flex-wrap gap-3">
        <div>
            <span class="text-xs text-slate-400 uppercase tracking-wider block">Total Omset Halaman Ini</span>
            <span class="text-xl font-extrabold text-primary font-mono block mt-1">Rp{{ number_format($totalPerPage, 0, ',', '.') }}</span>
        </div>
        <div>
            <span class="text-xs text-slate-400 uppercase tracking-wider block">Rentang Laporan</span>
            <span class="text-sm font-semibold text-slate-700 block mt-1 font-mono">
                {{ \Carbon\Carbon::parse($start)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($end)->format('d M Y') }}
            </span>
        </div>
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100 mb-4">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                <tr>
                    <th class="px-6 py-4 text-left">Kode Invoice</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-right">Total Transaksi</th>
                    <th class="px-6 py-4 text-center">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($orders as $order)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4 font-mono font-medium text-slate-600">{{ $order->invoice_code }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $order->order_date->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 text-right font-bold text-dark font-mono">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase
                            {{ $order->payment_method === 'qris'
                                ? 'bg-indigo-50 text-indigo-700 border border-indigo-100'
                                : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                            {{ $order->payment_method }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium">
                        Tidak ada data penjualan untuk rentang tanggal tersebut.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARDS -->
    <div class="sm:hidden space-y-4 mb-4">
        @forelse ($orders as $order)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="flex justify-between items-start">
                <div class="font-mono font-semibold text-dark">{{ $order->invoice_code }}</div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase
                    {{ $order->payment_method === 'qris'
                        ? 'bg-indigo-50 text-indigo-700 border border-indigo-100'
                        : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                    {{ $order->payment_method }}
                </span>
            </div>
            <div class="mt-2 text-xs space-y-1 text-slate-500 border-t border-slate-50 pt-2">
                <div>Tanggal: <span class="font-mono">{{ $order->order_date->format('d-m-Y') }}</span></div>
                <div>Total: <span class="font-bold text-primary font-mono text-sm">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></div>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8">
            Tidak ada data penjualan untuk rentang tanggal tersebut.
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div>
        {{ $orders->links() }}
    </div>

</div>
@endsection
