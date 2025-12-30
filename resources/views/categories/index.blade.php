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

        <a href="{{ route('categories.create') }}"
           class="mt-4 sm:mt-0 inline-flex items-center gap-2
                  bg-[#5d4037] text-white font-semibold
                  px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
            <i class="fas fa-plus"></i>
            Tambah
        </a>
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
@endsection
