@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Riwayat Order</h1>

        <!-- Flash message success -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card for "Create New Order" -->
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Buat Order Baru</a>
            <a href="{{ route('orders.report') }}" class="btn btn-info">📊 Laporan Penjualan</a>
        </div>

        <!-- Table for orders -->
        <table class="table table-striped table-bordered order-table">
            <thead>
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
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-secondary">Print</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada order.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Back Link -->
        <div class="back-link text-center mt-3">
            <a href="{{ route('home') }}">← Kembali ke Dashboard</a>
        </div>
    </div>
@endsection
