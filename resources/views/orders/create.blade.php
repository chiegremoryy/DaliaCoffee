<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Order Baru</title>
    <!-- Link to Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-item {
            margin-bottom: 15px;
        }
        .order-item select, .order-item input {
            margin-right: 10px;
        }
        .order-item button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .order-item button:hover {
            background-color: #c0392b;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .back-link a {
            text-decoration: none;
            color: #3498db;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container mt-5 form-container">
        <h1 class="text-center mb-4">Buat Order Baru</h1>

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
                <div class="order-item">
                    <select name="items[0][menu_id]" class="form-select" required>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }} (Rp{{ number_format($menu->price) }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][quantity]" placeholder="Jumlah" class="form-control" min="1" required>
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">🗑</button>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="addItem()">+ Tambah Item</button><br><br>

            <button type="submit" class="btn btn-primary w-100">Simpan Order</button>
        </form>

        <!-- Back Link -->
        <div class="back-link mt-3 text-center">
            <a href="{{ route('orders.index') }}">← Kembali</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let index = 1;
        function addItem() {
            const wrapper = document.getElementById('order-items');
            const div = document.createElement('div');
            div.classList.add('order-item');
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

</body>
</html>
