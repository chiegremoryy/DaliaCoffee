@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Order</h1>

    <!-- Tombol Buat Order Baru -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createOrderModal">
        + Buat Order Baru
    </button>

    <!-- Tabel Order -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->invoice_code }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ strtoupper($order->payment_method) }}</td>
                <td>Rp{{ number_format($order->total_amount) }}</td>
                <td>
                    <a href="{{ route('orders.print', $order->id) }}" class="btn btn-sm btn-primary" target="_blank">🖨 Cetak</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
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
