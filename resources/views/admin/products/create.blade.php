@extends('layouts.admin.admin')

@section('title', 'Tambah Produk')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-header"><h3 class="card-title">Tambah Produk</h3></div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Produk -->
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Produk</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <!-- Kategori -->
            <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Promo -->
            <div class="mb-3">
                <label class="form-label fw-bold">Promo</label>
                <select name="promo_id" class="form-select">
                    <option value="">-- Tidak ada Promo --</option>
                    @foreach($promos as $promo)
                        <option value="{{ $promo->id }}">
                            {{ $promo->title }} (Diskon {{ $promo->discount_percent }}%)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stock" class="form-control" min="0" required>
            </div>
            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label fw-bold">Gambar Produk</label>
                <input type="file" name="image" class="form-control">
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
