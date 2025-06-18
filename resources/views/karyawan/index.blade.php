@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Karyawan / Kasir</h1>

    <!-- Tombol tambah karyawan -->
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">+ Tambah Karyawan</a>

    <!-- Tabel karyawan -->
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('karyawan.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data karyawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Link kembali -->
    <div class="mt-3">
        <a href="{{ route('home') }}">← Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection
