@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h1>Daftar Menu</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->category->name ?? '-' }}</td>
                        <td>Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($menu->status) }}</td>
                        <td class="btn-group">
                            <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('menu.show', $menu->id) }}" class="btn btn-info btn-sm">More</a>
                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
