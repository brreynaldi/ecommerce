@extends('layouts.admin.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="container my-4">
    <h2 class="fw-bold mb-4">Edit Kategori</h2>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
