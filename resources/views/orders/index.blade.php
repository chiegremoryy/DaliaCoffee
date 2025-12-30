@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Riwayat Transaksi
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Kelola semua transaksi yang telah dilakukan
            </p>
        </div>

        <div class="mt-4 sm:mt-0 flex gap-2">
            <!-- Tombol buat order -->
            <a href="{{ route('orders.create') }}" class="inline-flex items-center gap-2 bg-[#5d4037] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
                <i class="fas fa-plus"></i>
                Buat Order
            </a>

            <!-- Laporan -->
            <a href="{{ route('orders.report') }}" class="inline-flex items-center gap-2 bg-[#0288d1] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#0277bd] transition">
                <i class="fas fa-chart-line"></i>
                Laporan Penjualan
            </a>
        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Invoice</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Jumlah Item</th>
                    <th class="px-6 py-4 w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse($orders as $order)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $order->invoice_code }}</td>
                    <td class="px-6 py-4">{{ $order->order_date->format('d M Y') }}</td>
                    <td class="px-6 py-4">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $order->orderItems->sum('quantity') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn-print">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada order.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARDS -->
    <div class="sm:hidden space-y-4 p-1">
        @foreach($orders as $order)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">{{ $order->invoice_code }}</div>
            <div class="text-sm text-[#6d4c41] mt-1">{{ $order->order_date->format('d M Y') }}</div>
            <div class="text-sm mt-1">Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</div>
            <div class="text-sm mt-1">Jumlah Item: {{ $order->orderItems->sum('quantity') }}</div>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('orders.show', $order->id) }}" class="btn-view">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn-print">
                    <i class="fas fa-print"></i>
                </a>
            </div>
        </div>
        @endforeach

        <!-- PAGINATION MOBILE -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- PAGINATION DESKTOP -->
    <div class="mt-4 hidden sm:block">
        {{ $orders->links() }}
    </div>
</div>

<!-- STYLE -->
<style>
.btn-view {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #81d4fa;
    color: #01579b;
}

.btn-print {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #cfd8dc;
    color: #37474f;
}
</style>
@endsection
