@extends('layouts.admin.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Produk: {{ $product->name }}</h3>
    </div>
    <div class="card-body">
        <!-- Tampilkan error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Promo -->
            <div class="mb-3">
                <label class="form-label fw-bold">Promo</label>
                <select name="promo_id" class="form-select">
                    <option value="">-- Tidak ada Promo --</option>
                    @foreach($promos as $promo)
                        <option value="{{ $promo->id }}" {{ old('promo_id', $product->promo_id) == $promo->id ? 'selected' : '' }}>
                            {{ $promo->title }} (Diskon {{ $promo->discount_percent }}%)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label fw-bold">Gambar Produk</label>
                <input type="file" name="image" class="form-control">
                @if ($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="120" class="rounded shadow-sm">
                    </div>
                @endif
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
