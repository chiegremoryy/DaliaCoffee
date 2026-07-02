@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-semibold text-dark font-poppins">
                Karyawan
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                Kelola data akun kasir kedai
            </p>
        </div>

        <a href="{{ route('karyawan.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all duration-200">
            <iconify-icon icon="solar:user-plus-linear" width="20"></iconify-icon>
            Tambah Karyawan
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
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                    <td class="px-6 py-4 text-center font-medium text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#f3f0ff] flex items-center justify-center text-primary text-xs font-bold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <span class="font-semibold text-dark">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('karyawan.edit', $user->id) }}"
                               class="btn-edit-premium">
                                <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
                            </a>

                            <form action="{{ route('karyawan.destroy', $user->id) }}"
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
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium">
                        Belum ada data karyawan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE CARD -->
    <div class="sm:hidden space-y-4">
        @forelse ($users as $user)
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#f3f0ff] flex items-center justify-center text-primary text-xs font-bold">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="font-semibold text-dark">{{ $user->name }}</div>
                    <div class="text-xs text-slate-400">{{ $user->email }}</div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-4 border-t border-slate-50 pt-3">
                <a href="{{ route('karyawan.edit', $user->id) }}" class="btn-edit-premium">
                    <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
                </a>

                <form action="{{ route('karyawan.destroy', $user->id) }}"
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
            Belum ada data karyawan
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
            title: 'Hapus karyawan?',
            text: 'Data yang dihapus tidak dapat dikembalikan',
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
