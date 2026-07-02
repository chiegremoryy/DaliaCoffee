@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">
                Data Menu
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                Kelola data makanan, minuman, dan menu lainnya
            </p>
        </div>

        <a href="{{ route('menu.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200">
            <iconify-icon icon="solar:tea-cup-linear" width="20"></iconify-icon>
            Tambah Menu
        </a>
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-800 border border-emerald-100 px-4 py-3 rounded-xl flex items-center gap-2">
            <iconify-icon icon="solar:check-circle-linear" class="text-emerald-600" width="20"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-100">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                <tr>
                    <th class="px-6 py-4 text-center w-16">#</th>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Kategori</th>
                    <th class="px-6 py-4 text-right">Harga</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($menus as $menu)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4 text-center font-medium text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="w-10 h-10 object-cover rounded-xl" alt="{{ $menu->name }}">
                            @else
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                                    <iconify-icon icon="solar:gallery-linear" width="20"></iconify-icon>
                                </div>
                            @endif
                            <span class="font-semibold text-dark">{{ $menu->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-slate-600">{{ $menu->category->name ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right font-medium text-dark">
                        Rp{{ number_format($menu->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                            {{ $menu->status === 'active'
                                ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                                : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                            {{ $menu->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('menu.edit', $menu->id) }}"
                               class="btn-edit-premium">
                                <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
                            </a>

                            <form action="{{ route('menu.destroy', $menu->id) }}"
                                  method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete-premium">
                                    <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-medium">
                        Belum ada menu tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @forelse ($menus as $menu)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" class="w-12 h-12 object-cover rounded-xl" alt="{{ $menu->name }}">
                @else
                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                        <iconify-icon icon="solar:gallery-linear" width="20"></iconify-icon>
                    </div>
                @endif
                <div class="flex-1">
                    <div class="font-semibold text-dark">{{ $menu->name }}</div>
                    <div class="text-xs text-slate-400">{{ $menu->category->name ?? '-' }}</div>
                    <div class="text-sm font-semibold text-primary mt-1">Rp{{ number_format($menu->price, 0, ',', '.') }}</div>
                </div>
                <div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold
                        {{ $menu->status === 'active'
                            ? 'bg-emerald-50 text-emerald-700 border border-emerald-100'
                            : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                        {{ $menu->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4 border-t border-slate-50 pt-3">
                <a href="{{ route('menu.edit', $menu->id) }}" class="btn-edit-premium">
                    <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
                </a>

                <form action="{{ route('menu.destroy', $menu->id) }}"
                      method="POST" class="form-delete">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete-premium">
                        <iconify-icon icon="solar:trash-bin-trash-linear" width="18"></iconify-icon>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8">
            Belum ada menu tersedia
        </div>
        @endforelse
    </div>

</div>

<!-- STYLE -->
<style>
.btn-edit-premium {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #e6fcf5;
    color: #0ca678;
    transition: all 0.2s ease;
}
.btn-edit-premium:hover {
    background: #c3fae8;
    transform: scale(1.05);
}
.btn-delete-premium {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #fff0f6;
    color: #e64980;
    transition: all 0.2s ease;
}
.btn-delete-premium:hover {
    background: #ffdeeb;
    transform: scale(1.05);
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
            confirmButtonColor: '#5802f7',
            cancelButtonColor: '#e64980',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(res => {
            if (res.isConfirmed) form.submit();
        });
    });
});
</script>
@endsection
