@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-6xl mx-auto bg-[#fff8f0] rounded-3xl shadow-xl p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-[#3e2723]">
                Kategori
            </h2>
            <p class="text-sm text-[#6d4c41]">
                Kelola kategori produk kopi
            </p>
        </div>

<<<<<<< HEAD
        <a href="{{ route('categories.create') }}"
           class="mt-4 sm:mt-0 inline-flex items-center gap-2
                  bg-[#5d4037] text-white font-semibold
                  px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
            <i class="fas fa-plus"></i>
            Tambah
        </a>
=======
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori
                </button>
            </div>

            <!-- Tabel kategori -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $category->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button 
                                        class="btn btn-warning btn-sm text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-x-auto rounded-2xl border border-[#d7ccc8]">
        <table class="min-w-full text-sm">
            <thead class="bg-[#efebe9] text-[#4e342e] uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-center w-16">#</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-[#d7ccc8]">
                @foreach ($categories as $category)
                <tr>
                    <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('categories.edit',$category->id) }}"
                               class="btn-edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('categories.destroy',$category->id) }}"
                                  method="POST" class="form-delete">
                                @csrf @method('DELETE')
                                <button class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @foreach ($categories as $category)
        <div class="bg-white rounded-xl border p-4 shadow-sm">
            <div class="font-semibold text-[#3e2723]">
                {{ $category->name }}
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('categories.edit',$category->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i>
                </a>

                <form action="{{ route('categories.destroy',$category->id) }}"
                      method="POST" class="form-delete">
                    @csrf @method('DELETE')
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
<style>
.btn-edit {
    width: 36px; height: 36px;
    display:flex; align-items:center; justify-content:center;
    border-radius:8px;
    background:#ffcc80; color:#5d4037;
}
.btn-delete {
    width: 36px; height: 36px;
    display:flex; align-items:center; justify-content:center;
    border-radius:8px;
    background:#ef9a9a; color:#b71c1c;
}
</style>

<script>
document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        Swal.fire({
            title: 'Hapus kategori?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5d4037'
        }).then(res => {
            if(res.isConfirmed) form.submit();
        });
    });
});
</script>
=======
<!-- MODAL TAMBAH -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-category-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="name" id="edit-name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk isi data modal edit -->
<script>
    const editModal = document.getElementById('editCategoryModal');
    editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const categoryId = button.getAttribute('data-id');
        const categoryName = button.getAttribute('data-name');

        const form = editModal.querySelector('#editCategoryForm');
        form.setAttribute('action', `/categories/${categoryId}`);
        editModal.querySelector('#edit-name').value = categoryName;
    });
</script>

>>>>>>> ecee0864c8195647650ba18b1d923e7973cc7118
@endsection
