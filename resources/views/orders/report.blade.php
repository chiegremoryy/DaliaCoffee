@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">Laporan Penjualan</h2>
        <p class="text-sm text-[#6d4c41]">Filter dan cetak laporan penjualan</p>
    </div>

    <!-- FILTER FORM -->
    <form method="GET" action="{{ route('orders.report') }}" class="flex flex-col sm:flex-row sm:items-end gap-4 mb-6">
        <div class="flex-1">
            <label for="start_date" class="block text-sm font-medium text-[#6d4c41] mb-1">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                   class="w-full rounded-lg border border-[#d7ccc8] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#5d4037]">
        </div>
        <div class="flex-1">
            <label for="end_date" class="block text-sm font-medium text-[#6d4c41] mb-1">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                   class="w-full rounded-lg border border-[#d7ccc8] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#5d4037]">
        </div>
        <div class="flex gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#5d4037] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="{{ route('orders.export.pdf', request()->only('start_date','end_date')) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-[#ef5350] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#d32f2f] transition">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </form>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Invoice</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-right">Total</th>
                    <th class="px-6 py-4">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse ($orders as $order)
                <tr>
                    <td class="px-6 py-4">{{ $order->invoice_code }}</td>
                    <td class="px-6 py-4">{{ $order->order_date->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 text-right font-semibold">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 capitalize">{{ $order->payment_method }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-[#6d4c41]">
                        Tidak ada data penjualan untuk rentang tanggal tersebut.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARDS -->
    <div class="sm:hidden space-y-4">
        @forelse ($orders as $order)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">{{ $order->invoice_code }}</div>
            <div class="text-sm text-[#6d4c41] mt-1 space-y-1">
                <div>Tanggal: {{ $order->order_date->format('d-m-Y') }}</div>
                <div>Total: <span class="font-semibold">Rp{{ number_format($order->total_amount,0,',','.') }}</span></div>
                <div>Metode: {{ ucfirst($order->payment_method) }}</div>
            </div>
        </div>
        @empty
        <div class="text-center text-[#6d4c41] py-6">
            Tidak ada data penjualan untuk rentang tanggal tersebut.
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>

</div>
@endsection
