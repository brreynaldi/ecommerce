@extends('layouts.admin.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container my-4">
    <h2 class="fw-bold mb-4">Tambah Kategori</h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama kategori" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
