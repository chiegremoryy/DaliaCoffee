@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center border-bottom">
            <h2 class="mb-0 text-dark fw-semibold">Laporan Penjualan</h2>
        </div>

        <div class="card-body">

            <!-- Filter Form -->
            <form method="GET" action="{{ route('orders.report') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-4">
                    <label for="from" class="form-label">Dari Tanggal</label>
                    <input type="date" name="from" id="from" value="{{ request('from') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="to" class="form-label">Sampai Tanggal</label>
                    <input type="date" name="to" id="to" value="{{ request('to') }}" class="form-control">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('orders.export.pdf', request()->only('from', 'to')) }}" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </form>

            <!-- Sales Report Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_code }}</td>
                                <td>{{ $order->order_date->format('d-m-Y') }}</td>
                                <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data penjualan untuk rentang tanggal tersebut.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
