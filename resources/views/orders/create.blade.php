@extends('layouts.app')

@section('content')
    <div
        class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('orders.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                    <iconify-icon icon="solar:arrow-left-linear" width="20"></iconify-icon>
                </a>
                <h2 class="text-2xl font-semibold text-dark font-poppins">Buat Pesanan Baru</h2>
            </div>
            <p class="text-sm text-slate-400">
                Pilih menu makanan/minuman dan masukkan jumlah pesanan kasir
            </p>
        </div>

        <!-- Error Validation -->
        @if($errors->any())
            <div class="mb-6 bg-rose-50 text-rose-800 border border-rose-100 px-4 py-3 rounded-xl space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="solar:info-circle-linear" class="text-rose-500" width="16"></iconify-icon>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Form Order -->
        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6" id="order-form">
            @csrf

            <!-- Payment Method -->
            <div>
                <label for="payment_method"
                    class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
                    Metode Pembayaran
                </label>
                <select name="payment_method" id="payment_method" required
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-dark focus:outline-none focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all">
                    <option value="cash">Tunai (Cash)</option>
                    <option value="qris">QRIS (Digital)</option>
                </select>
            </div>

            <!-- Order Items Section -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        Daftar Item Pesanan
                    </label>
                    <button type="button" onclick="addItem()"
                        class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                        <iconify-icon icon="solar:add-circle-linear" width="16"></iconify-icon>
                        Tambah Item
                    </button>
                </div>

                <div id="order-items" class="space-y-3">
                    <div
                        class="order-item grid grid-cols-1 sm:grid-cols-[1fr_120px_48px] gap-3 items-center bg-slate-50/50 border border-slate-100 rounded-xl p-3">
                        <select name="items[0][menu_id]" required
                            class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">
                                    {{ $menu->name }} (Rp{{ number_format($menu->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>

                        <input type="number" name="items[0][quantity]" placeholder="Jumlah" min="1" required
                            class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">

                        <button type="button" onclick="removeItem(this)"
                            class="h-11 w-11 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition-colors">
                            <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-300">
                Proses Transaksi & Simpan
            </button>

        </form>

    </div>

    @push('scripts')
        <script>
            let itemIndex = 1;
            const orderItemsContainer = document.getElementById('order-items');
            const menuOptionsHtml = `@foreach($menus as $menu)<option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price, 0, ',', '.') }})</option>@endforeach`;

            function addItem() {
                const div = document.createElement('div');
                div.className = 'order-item grid grid-cols-1 sm:grid-cols-[1fr_120px_48px] gap-3 items-center bg-slate-50/50 border border-slate-100 rounded-xl p-3';
                div.innerHTML = `
                    <select name="items[${itemIndex}][menu_id]" required
                        class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">
                        ${menuOptionsHtml}
                    </select>

                    <input type="number" name="items[${itemIndex}][quantity]" placeholder="Jumlah" min="1" required
                        class="h-11 px-3 rounded-lg border border-slate-200 bg-white text-sm focus:outline-none focus:border-primary/50">

                    <button type="button" onclick="removeItem(this)"
                        class="h-11 w-11 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition-colors">
                        <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                    </button>
                `;
                orderItemsContainer.appendChild(div);
                itemIndex++;
            }

            function removeItem(button) {
                const item = button.closest('.order-item');
                const allItems = orderItemsContainer.querySelectorAll('.order-item');
                if (allItems.length > 1) {
                    item.remove();
                } else {
                    Swal.fire({
                        title: 'Info',
                        text: 'Pesanan minimal harus memiliki satu menu.',
                        icon: 'info',
                        confirmButtonColor: '#5802f7'
                    });
                }
            }
        </script>
    @endpush
@endsection