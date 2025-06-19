@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Menu Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('menu._form', ['menu' => null, 'menuIngredients' => []])

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{ route('menu.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
