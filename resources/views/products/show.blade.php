@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" 
            class="img-fluid rounded shadow" 
            alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">Kategori: {{ $product->category->name ?? '-' }}</p>

            <h4 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
            <h4>Description: {{ $product->description }}</h4>
            

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control w-auto" value="1" min="1">
            </div>

            <a href="{{ route('checkout.product', $product->id) }}" class="btn btn-success btn-lg">Beli Sekarang</a>

            <button class="btn btn-outline-danger btn-lg">❤️ Wishlist</button>
        </div>
    </div>
</div>

<div class="container my-5">
    <h4 class="fw-bold mb-3">Ulasan Produk</h4>
    <div class="border rounded p-3 mb-3">
        <strong>Andi</strong> ⭐⭐⭐⭐☆
        <p>Hasil kaos sesuai dengan desain saya, recommended!</p>
    </div>
    <div class="border rounded p-3 mb-3">
        <strong>Mei Ling</strong> ⭐⭐⭐⭐⭐
        <p>Bahan adem, harga terjangkau, pengiriman cepat.</p>
    </div>
</div>
@endsection
