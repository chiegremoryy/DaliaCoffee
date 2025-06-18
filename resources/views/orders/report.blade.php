@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">📊 Laporan Penjualan</h1>

        <!-- Filter Form -->
        <div class="form-container mb-3">
            <form method="GET" action="{{ route('orders.report') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="from" class="form-label">Dari Tanggal:</label>
                    <input type="date" name="from" id="from" value="{{ request('from') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="to" class="form-label">Sampai Tanggal:</label>
                    <input type="date" name="to" id="to" value="{{ request('to') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">🔍 Filter</button>
                    <a href="{{ route('orders.export.pdf', request()->only('from', 'to')) }}" target="_blank" class="btn btn-danger ms-2">📄 Export PDF</a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Metode</th>
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
                        <td colspan="4" class="text-center">Tidak ada data pada rentang tanggal tersebut.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
