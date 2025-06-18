@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="payment-method" class="form-label">Metode Pembayaran:</label>
        <select name="payment_method" id="payment-method" class="form-select" required>
            <option value="cash">Cash</option>
            <option value="qris">QRIS</option>
        </select>
    </div>

    <div id="order-items">
        <div class="d-flex gap-2 mb-2">
            <select name="items[0][menu_id]" class="form-select" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price) }})</option>
                @endforeach
            </select>
            <input type="number" name="items[0][quantity]" placeholder="Jumlah" class="form-control" min="1" required>
            <button type="button" class="btn btn-danger" onclick="removeItem(this)">🗑</button>
        </div>
    </div>

    <button type="button" class="btn btn-secondary mb-3" onclick="addItem()">+ Tambah Item</button>

    <button type="submit" class="btn btn-primary w-100">Simpan Order</button>
</form>

<script>
    let index = 1;
    function addItem() {
        const wrapper = document.getElementById('order-items');
        const div = document.createElement('div');
        div.classList.add('d-flex', 'gap-2', 'mb-2');
        div.innerHTML = `
            <select name="items[${index}][menu_id]" class="form-select" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price) }})</option>
                @endforeach
            </select>
            <input type="number" name="items[${index}][quantity]" placeholder="Jumlah" class="form-control" min="1" required>
            <button type="button" class="btn btn-danger" onclick="removeItem(this)">🗑</button>
        `;
        wrapper.appendChild(div);
        index++;
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>
