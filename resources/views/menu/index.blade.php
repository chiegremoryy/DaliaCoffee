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

        <a href="{{ route('menu.create') }}"
           class="mt-4 sm:mt-0 inline-flex items-center gap-2
                  bg-[#5d4037] text-white font-semibold
                  px-5 py-3 rounded-xl hover:bg-[#4e342e] transition">
            <i class="fas fa-plus"></i>
            Tambah Menu
        </a>
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