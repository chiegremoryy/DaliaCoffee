@extends('layouts.app')

@section('content')
@php
    $hour = now()->format('H');
    $greeting = 'Pagi';
    if ($hour >= 11 && $hour < 15) {
        $greeting = 'Siang';
    } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'Sore';
    } elseif ($hour >= 18 || $hour < 5) {
        $greeting = 'Malam';
    }
@endphp

<!-- Content Container -->
<div class="space-y-8">
    
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-end gap-4 justify-between">
        <div>
            <h1 class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Selamat {{ $greeting }}, {{ Auth::user()->name }}</h1>
            <p class="text-slate-500 font-poppins">Berikut adalah ringkasan performa kedai kopi Anda hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 bg-white hover:shadow-sm hover:border-primary/30 hover:text-primary transition-all">
                <iconify-icon icon="solar:calendar-date-linear" width="18" height="18" style="color: rgb(88, 2, 247);"></iconify-icon>
                <span>10 Hari Terakhir</span>
            </button>
            <a href="{{ route('orders.report') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                <iconify-icon icon="solar:document-text-linear" width="18"></iconify-icon>
                <span>Lihat Laporan</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Revenue -->
        <div class="hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 group bg-white border-slate-50 border rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-pastelPurple text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:dollar-minimalistic-linear" width="24" stroke-width="1.5"></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold {{ $revenueGrowth >= 0 ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }} px-2 py-1 rounded-full">
                    {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}% 
                    <iconify-icon icon="solar:{{ $revenueGrowth >= 0 ? 'arrow-right-up-linear' : 'arrow-right-down-linear' }}" class="ml-1"></iconify-icon>
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">Total Pendapatan</h3>
            <p class="text-dark text-2xl font-bold font-poppins">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <!-- Card 2: Total Orders -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:bag-3-linear" width="24" stroke-width="1.5"></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    Aktif
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">Total Transaksi</h3>
            <p class="text-dark text-2xl font-bold font-poppins">{{ number_format($totalOrders) }}</p>
        </div>

        <!-- Card 3: Total Karyawan -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:users-group-two-rounded-linear" width="24" stroke-width="1.5"></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    Kasir
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">Total Karyawan</h3>
            <p class="text-dark text-2xl font-bold font-poppins">{{ number_format($totalKaryawan) }}</p>
        </div>

        <!-- Card 4: Total Menus -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:pie-chart-2-linear" width="24" stroke-width="1.5"></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    Item
                </span>
            </div>
            <h3 class="text-sm font-medium text-slate-400 mb-1">Jumlah Menu</h3>
            <p class="text-dark text-2xl font-bold font-poppins">{{ number_format($totalMenus) }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Chart -->
        <div class="lg:col-span-2 bg-white border-slate-50 border rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-dark text-lg font-semibold font-poppins">Tren Pendapatan</h3>
                    <p class="text-xs text-slate-400">Pendapatan harian 10 hari terakhir</p>
                </div>
            </div>
            <div class="h-64 w-full relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Side Widget/Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 flex flex-col">
            <h3 class="text-dark text-lg font-semibold font-poppins mb-1">Metode Pembayaran</h3>
            <p class="text-xs text-slate-400 mb-6">Persentase Cash vs QRIS</p>
            
            <div class="relative h-48 w-full flex justify-center mb-4">
                <canvas id="deviceChart"></canvas>
            </div>
            
            <div class="mt-auto space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-primary"></span>
                        <span class="text-slate-600">QRIS</span>
                    </div>
                    <span class="font-semibold text-dark">{{ $qrisCount }} Transaksi</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-teal-400"></span>
                        <span class="text-slate-600">Tunai (Cash)</span>
                    </div>
                    <span class="font-semibold text-dark">{{ $cashCount }} Transaksi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-dark text-lg font-semibold font-poppins">Transaksi Terbaru</h3>
                <p class="text-xs text-slate-400">Riwayat transaksi kedai</p>
            </div>
            <a href="{{ route('orders.report') }}" class="px-4 py-2 text-sm border border-slate-200 rounded-lg hover:bg-slate-50 text-slate-500 hover:text-primary transition-colors text-center">
                Lihat Semua
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                        <th class="px-6 py-4">Kode Invoice</th>
                        <th class="px-6 py-4">Kasir</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($recentOrders as $order)
                        <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                            <td class="px-6 py-4 font-mono text-slate-500">{{ $order->invoice_code }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">
                                        {{ strtoupper(substr($order->cashier->name ?? 'KS', 0, 2)) }}
                                    </div>
                                    <span class="font-medium text-dark">{{ $order->cashier->name ?? 'Kasir' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 uppercase">{{ $order->payment_method }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $order->order_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-medium text-dark">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Selesai</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-slate-400 hover:text-primary transition-colors inline-block p-1">
                                    <iconify-icon icon="solar:eye-linear" width="20"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-400">
                                Belum ada transaksi terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Chart.defaults.font.family = "'Montserrat', sans-serif";
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.scale.grid.color = '#f1f5f9';
        Chart.defaults.scale.grid.borderColor = 'transparent';

        // Revenue Chart (Line with Gradient)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        
        let gradient = ctxRevenue.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(88, 2, 247, 0.2)');
        gradient.addColorStop(1, 'rgba(88, 2, 247, 0)');

        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($revenueData) !!},
                    borderColor: '#5802f7',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#5802f7',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'white',
                        titleColor: '#1a1a1a',
                        bodyColor: '#64748b',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4] },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Device Chart (Doughnut - Cash vs QRIS)
        const ctxDevice = document.getElementById('deviceChart').getContext('2d');
        const qrisVal = {{ $qrisCount }};
        const cashVal = {{ $cashCount }};
        const totalVal = qrisVal + cashVal;
        
        new Chart(ctxDevice, {
            type: 'doughnut',
            data: {
                labels: ['QRIS', 'Tunai'],
                datasets: [{
                    data: totalVal === 0 ? [1, 1] : [qrisVal, cashVal],
                    backgroundColor: [
                        '#5802f7', // Primary (QRIS)
                        '#2dd4bf'  // Teal (Cash)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'white',
                        bodyColor: '#1a1a1a',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                if (totalVal === 0) {
                                    return context.label + ': 0 (0%)';
                                }
                                const val = context.raw;
                                const pct = ((val / totalVal) * 100).toFixed(0);
                                return context.label + ': ' + val + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
