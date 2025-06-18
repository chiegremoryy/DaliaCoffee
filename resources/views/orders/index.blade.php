@extends('layouts.app')

@section('content')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center border-bottom">
            <h2 class="mb-0 text-dark fw-semibold">Riwayat Transaksi</h2>
        </div>

        <div class="card-body">
            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mb-3">
                <!-- Tombol Modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOrderModal">
                    <i class="fas fa-plus me-1"></i> Buat Order Baru
                </button>
                <a href="{{ route('orders.report') }}" class="btn btn-info text-white">
                    <i class="fas fa-chart-line me-1"></i> Laporan Penjualan
                </a>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Jumlah Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_code }}</td>
                                <td>{{ $order->order_date->format('d M Y') }}</td>
                                <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>{{ $order->orderItems->sum('quantity') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-secondary" title="Cetak">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Order -->
<div class="modal fade" id="createOrderModal" tabindex="-1" aria-labelledby="createOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Order Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @include('orders.create', ['menus' => \App\Models\Menu::where('status', 'active')->get()])
            </div>
        </div>
    </div>
</div>
@endsection
