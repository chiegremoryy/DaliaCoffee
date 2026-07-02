@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- Header -->
    <div class="mb-8 border-b border-slate-100 pb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('orders.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
            </a>
            <h2 class="text-2xl font-semibold text-dark font-poppins">Detail Transaksi</h2>
        </div>
        <p class="text-sm text-slate-400">
            Rincian menu belanja dan pembayaran untuk invoice <strong>{{ $order->invoice_code }}</strong>
        </p>
    </div>

    <!-- Info Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4">
            <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Tanggal Transaksi</span>
            <span class="font-bold text-dark text-sm block font-mono">{{ $order->order_date->format('d M Y') }}</span>
        </div>

        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4">
            <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Metode Pembayaran</span>
            <span class="inline-flex items-center mt-1 px-3 py-1 rounded-full text-xs font-semibold uppercase
                {{ $order->payment_method === 'qris'
                    ? 'bg-indigo-50 text-indigo-700 border border-indigo-100'
                    : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                {{ $order->payment_method ?? '-' }}
            </span>
        </div>

        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4">
            <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Kasir yang Melayani</span>
            <span class="font-bold text-dark text-sm block">{{ $order->cashier->name ?? 'Kasir' }}</span>
        </div>
    </div>

    <!-- Desktop Table -->
    <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100 mb-6">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                <tr>
                    <th class="px-6 py-4 text-left">Nama Menu</th>
                    <th class="px-6 py-4 text-center w-24">Jumlah</th>
                    <th class="px-6 py-4 text-right w-40">Harga Satuan</th>
                    <th class="px-6 py-4 text-right w-48">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-600">
                @foreach($order->orderItems as $item)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4">
                        <span class="font-semibold text-dark">{{ $item->menu->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-center font-mono font-medium">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-right font-mono">
                        Rp{{ number_format($item->price_per_item,0,',','.') }}
                    </td>
                    <td class="px-6 py-4 text-right font-bold text-dark font-mono">
                        Rp{{ number_format($item->subtotal,0,',','.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-slate-50/50 border-t border-slate-100 font-semibold text-sm">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right text-dark">Total Transaksi</td>
                    <td class="px-6 py-4 text-right text-primary text-base font-bold font-mono">
                        Rp{{ number_format($order->total_amount,0,',','.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="sm:hidden space-y-4 mb-6">
        @foreach($order->orderItems as $item)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="font-semibold text-dark">{{ $item->menu->name }}</div>
            <div class="mt-2 text-xs space-y-1 text-slate-500 border-t border-slate-50 pt-2">
                <div class="flex justify-between"><span>Jumlah:</span> <span class="font-mono text-dark">{{ $item->quantity }}</span></div>
                <div class="flex justify-between"><span>Harga Satuan:</span> <span class="font-mono text-dark">Rp{{ number_format($item->price_per_item,0,',','.') }}</span></div>
                <div class="flex justify-between font-semibold"><span>Subtotal:</span> <span class="font-mono text-primary">Rp{{ number_format($item->subtotal,0,',','.') }}</span></div>
            </div>
        </div>
        @endforeach

        <div class="bg-slate-50/50 rounded-xl border border-slate-100 p-4 flex justify-between items-center text-sm font-semibold">
            <span class="text-dark">Total Transaksi</span>
            <span class="text-primary font-bold font-mono text-base">Rp{{ number_format($order->total_amount,0,',','.') }}</span>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-wrap items-center justify-center gap-3">
        <a href="{{ route('orders.print', $order->id) }}" target="_blank"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all text-sm">
            <iconify-icon icon="solar:printer-linear" width="18"></iconify-icon>
            Cetak Receipt
        </a>
        <a href="{{ route('orders.index') }}"
           class="inline-flex items-center gap-2 border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 font-semibold px-5 py-2.5 rounded-xl transition-all text-sm">
            Kembali ke Riwayat
        </a>
    </div>

</div>
@endsection