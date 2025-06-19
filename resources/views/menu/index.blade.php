@extends('layouts.app')

@section('content')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center border-bottom">
            <h2 class="mb-0 text-dark fw-semibold">Menu</h2>
        </div>

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
    </div>
</div>

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
