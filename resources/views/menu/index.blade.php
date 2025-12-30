@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Menu
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Kelola data menu
            </p>
        </div>

<<<<<<< HEAD
        <a href="{{ route('menu.create') }}"
           class="mt-4 sm:mt-0 inline-flex items-center gap-2
                  bg-[#5d4037] text-white font-semibold
                  px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
            <i class="fas fa-plus"></i>
            Tambah Menu
        </a>
=======
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <!-- Tombol Tambah Menu -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMenu">
                    <i class="fas fa-plus me-1"></i> Tambah Menu
                </button>
            </div>

            <!-- Tabel Menu -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                        <tr>
                            <td class="text-start">{{ $menu->name }}</td>
                            <td>{{ $menu->category->name ?? '-' }}</td>
                            <td>Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $menu->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($menu->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Tombol Detail -->
                                    <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $menu->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $menu->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $menu->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="detailModalLabel{{ $menu->id }}">Detail Menu: {{ $menu->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($menu->image)
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                        @endif
                                        <p><strong>Kategori:</strong> {{ $menu->category->name ?? '-' }}</p>
                                        <p><strong>Harga:</strong> Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($menu->status) }}</p>
                                        <p><strong>Deskripsi:</strong> {{ $menu->description ?? '-' }}</p>
                                        <h6 class="mt-3">Bahan yang Digunakan:</h6>
                                        @if($menu->menuIngredients->count() > 0)
                                            <ul class="list-group">
                                                @foreach($menu->menuIngredients as $mi)
                                                    <li class="list-group-item">{{ $mi->ingredient->name }} ({{ $mi->quantity }} {{ $mi->ingredient->unit }})</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">Tidak ada bahan.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5">Belum ada menu yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl">
            <i class="fas fa-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-center w-16">#</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @forelse ($menus as $menu)
                <tr>
                    <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium">{{ $menu->name }}</td>
                    <td class="px-6 py-4">{{ $menu->category->name ?? '-' }}</td>
                    <td class="px-6 py-4">
                        Rp{{ number_format($menu->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $menu->status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($menu->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('menu.edit', $menu->id) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('menu.destroy', $menu->id) }}"
                                  method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Belum ada menu tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @foreach ($menus as $menu)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">
                {{ $menu->name }}
            </div>
            <div class="text-sm text-[#6d4c41]">
                {{ $menu->category->name ?? '-' }}
            </div>
            <div class="text-sm mt-1">
                Rp{{ number_format($menu->price, 0, ',', '.') }}
            </div>

            <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold
                {{ $menu->status === 'active'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-gray-200 text-gray-600' }}">
                {{ ucfirst($menu->status) }}
            </span>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('menu.edit', $menu->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i>
                </a>

                <form action="{{ route('menu.destroy', $menu->id) }}"
                      method="POST" class="form-delete">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>

<<<<<<< HEAD
<!-- STYLE -->
<style>
.btn-edit {
    width: 36px;
    height: 36px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background:#ffcc80;
    color:#5d4037;
}
.btn-delete {
    width: 36px;
    height: 36px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background:#ef9a9a;
    color:#b71c1c;
}
</style>

<!-- SWEETALERT DELETE -->
<script>
document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        Swal.fire({
            title: 'Hapus menu?',
            text: 'Data menu yang dihapus tidak dapat dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5d4037',
            cancelButtonColor: '#b71c1c',
            confirmButtonText: 'Ya, hapus'
        }).then(res => {
            if (res.isConfirmed) form.submit();
        });
    });
});
</script>
@endsection
=======
<!-- Modal Tambah Menu -->
<div class="modal fade" id="modalTambahMenu" tabindex="-1" aria-labelledby="modalTambahMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalTambahMenuLabel">Tambah Menu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name">Nama Menu</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description">Deskripsi Menu</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="image">Foto Menu</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Bahan -->
                    <h6 class="mt-4">Bahan yang Digunakan</h6>
                    <div id="ingredient-wrapper">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <select name="ingredients[0][ingredient_id]" class="form-select">
                                    @foreach($allIngredients as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->unit }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="ingredients[0][quantity]" class="form-control" placeholder="Jumlah" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-success" onclick="addIngredientRow()">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS Tambah Bahan Dinamis -->
<script>
    let ingredientIndex = 1;
    function addIngredientRow() {
        const wrapper = document.getElementById('ingredient-wrapper');
        const row = document.createElement('div');
        row.className = 'row mb-2';
        row.innerHTML = `
            <div class="col-md-6">
                <select name="ingredients[${ingredientIndex}][ingredient_id]" class="form-select">
                    @foreach($allIngredients as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->unit }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="ingredients[${ingredientIndex}][quantity]" class="form-control" required placeholder="Jumlah">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.row').remove()">-</button>
            </div>
        `;
        wrapper.appendChild(row);
        ingredientIndex++;
    }
</script>
@endsection
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
