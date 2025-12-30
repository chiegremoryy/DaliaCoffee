@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Stok Bahan
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Riwayat transaksi & total stok bahan baku
            </p>
        </div>

<<<<<<< HEAD
        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="{{ route('stocks.create') }}"
                class="inline-flex items-center gap-2 bg-[#5d4037] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
                <i class="fas fa-plus"></i> Tambah Stok
            </a>
=======
        <div class="card-body">
            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahStokModal">
                    <i class="fas fa-plus me-1"></i> Tambah Stok Bahan
                </button>
                <a href="{{ route('ingredients.index') }}" class="btn btn-info text-white">
                    <i class="fas fa-list me-1"></i> Lihat Daftar Bahan Baku
                </a>
            </div>

            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tabel Riwayat Transaksi -->
            <h5 class="mt-4 mb-3 fw-semibold">Riwayat Transaksi Stok</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Bahan</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $stock->ingredient->name }}</td>
                                <td>{{ $stock->quantity }} {{ $stock->ingredient->unit }}</td>
                                <td>{{ ucfirst($stock->type) }}</td>
                                <td>{{ $stock->description }}</td>
                                <td>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus histori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada transaksi stok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Total Stok -->
            <h5 class="mt-5 mb-3 fw-semibold">Total Stok Saat Ini</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Bahan</th>
                            <th>Stok Tersedia</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name }}</td>
                                <td>{{ $ingredient->stock }}</td>
                                <td>{{ $ingredient->unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118

            <a href="{{ route('ingredients.index') }}"
                class="inline-flex items-center gap-2 bg-[#8d6e63] text-white font-semibold px-5 py-3 rounded-xl hover:bg-[#6d4c41] transition">
                <i class="fas fa-list"></i> Bahan Baku
            </a>
        </div>
    </div>

    <!-- ALERT -->
    @if (session('success'))
    <div class="mb-6 rounded-xl bg-green-100 text-green-800 px-5 py-3">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- ===================== -->
    <!-- RIWAYAT TRANSAKSI -->
    <!-- ===================== -->
    <h3 class="text-lg font-semibold text-[#3e2723] mb-3">
        Riwayat Transaksi Stok
    </h3>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8] mb-4">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Bahan</th>
                    <th class="px-6 py-4 text-center">Jumlah</th>
                    <th class="px-6 py-4 text-center">Jenis</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-center w-20">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse ($stocks as $stock)
                <tr>
                    <td class="px-6 py-4">{{ $stock->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $stock->ingredient->name }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $stock->quantity }} {{ $stock->ingredient->unit }}</td>
                    <td class="px-6 py-4 text-center capitalize">{{ $stock->type }}</td>
                    <td class="px-6 py-4">{{ $stock->description ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center">
                            <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                                @csrf @method('DELETE')
                                <button class="btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-[#6d4c41]">Belum ada transaksi stok</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4 mb-4">
        @forelse ($stocks as $stock)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">{{ $stock->ingredient->name }}</div>
            <div class="text-sm text-[#6d4c41] mt-2 space-y-1">
                <div>Tanggal: {{ $stock->created_at->format('d-m-Y H:i') }}</div>
                <div>Jumlah: <span class="font-semibold">{{ $stock->quantity }} {{ $stock->ingredient->unit }}</span></div>
                <div>Jenis: {{ ucfirst($stock->type) }}</div>
                <div>Ket: {{ $stock->description ?? '-' }}</div>
            </div>
            <div class="flex justify-end mt-4">
                <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" class="form-delete">
                    @csrf @method('DELETE')
                    <button class="btn-delete"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-[#6d4c41] py-6">Belum ada transaksi stok</div>
        @endforelse
    </div>

    <!-- PAGINATION RIWAYAT STOK -->
    <div class="mt-4">
        {{ $stocks->links('pagination::tailwind') }}
    </div>

    <!-- ===================== -->
    <!-- TOTAL STOK -->
    <!-- ===================== -->
    <h3 class="text-lg font-semibold text-[#3e2723] mb-3 mt-6">
        Total Stok Saat Ini
    </h3>

    <div class="overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Bahan</th>
                    <th class="px-6 py-4 text-center w-32">Stok</th>
                    <th class="px-6 py-4 text-center w-32">Satuan</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @foreach ($ingredients as $ingredient)
                <tr>
                    <td class="px-6 py-4">{{ $ingredient->name }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $ingredient->stock }}</td>
                    <td class="px-6 py-4 text-center">{{ $ingredient->unit }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<<<<<<< HEAD
<style>
    .btn-delete {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #ef9a9a;
        color: #b71c1c;
    }
</style>

<script>
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus histori stok?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5d4037'
            }).then(res => {
                if (res.isConfirmed) form.submit();
            });
        });
    });
=======
<!-- Modal Tambah Stok -->
<div class="modal fade" id="tambahStokModal" tabindex="-1" aria-labelledby="tambahStokModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahStokModalLabel">Tambah Stok Masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('stocks.store') }}">
          @csrf

          <div class="mb-3">
            <label for="ingredient_id" class="form-label">Bahan</label>
            <select name="ingredient_id" id="ingredientSelect" class="form-select" onchange="updateStockInfo()">
                <option value="">-- Pilih Bahan --</option>
                @foreach ($ingredients as $ing)
                    <option 
                        value="{{ $ing->id }}"
                        data-stock="{{ $ing->stock }}"
                        data-unit="{{ $ing->unit }}"
                    >
                        {{ $ing->name }}
                    </option>
                @endforeach
            </select>
          </div>

          <div class="mb-3" id="stockInfo" style="display: none">
            <strong>Stok Saat Ini:</strong> <span id="stockValue"></span>
          </div>

          <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah Tambahan</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
          </div>

          <input type="hidden" name="type" value="in">

          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (opsional)</label>
            <textarea name="description" id="description" class="form-control" rows="2"></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateStockInfo() {
        const select = document.getElementById('ingredientSelect');
        const selectedOption = select.options[select.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        const unit = selectedOption.getAttribute('data-unit');

        if (stock && unit) {
            document.getElementById('stockValue').innerText = `${stock} ${unit}`;
            document.getElementById('stockInfo').style.display = 'block';
        } else {
            document.getElementById('stockInfo').style.display = 'none';
        }
    }
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
</script>
@endsection
