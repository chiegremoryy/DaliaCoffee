<h1>Buat Order Baru</h1>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <label>Metode Pembayaran:</label>
    <select name="payment_method">
        <option value="cash">Cash</option>
        <option value="qris">QRIS</option>
    </select><br><br>

    <div id="order-items">
        <div class="item">
            <select name="items[0][menu_id]">
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price) }})</option>
                @endforeach
            </select>
            <input type="number" name="items[0][quantity]" placeholder="Jumlah" min="1">
            <button type="button" onclick="removeItem(this)">🗑</button>
        </div>
    </div>
    <button type="button" onclick="addItem()">+ Tambah Item</button><br><br>

    <button type="submit">Simpan Order</button>
</form>
<a href="{{ route('orders.index') }}">Kembali</a>

<script>
    let index = 1;
    function addItem() {
        const wrapper = document.getElementById('order-items');
        const div = document.createElement('div');
        div.classList.add('item');
        div.innerHTML = `
            <select name="items[${index}][menu_id]">
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price) }})</option>
                @endforeach
            </select>
            <input type="number" name="items[${index}][quantity]" placeholder="Jumlah" min="1">
            <button type="button" onclick="removeItem(this)">🗑</button>
        `;
        wrapper.appendChild(div);
        index++;
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>
