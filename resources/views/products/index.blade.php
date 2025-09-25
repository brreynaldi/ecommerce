@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <h2 class="mb-5 fw-bold">🛍️ Daftar Produk</h2>

    <div class="row g-6">
        @foreach($products as $product)
            <div class="col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <!-- Gambar Produk -->
                    <div class="position-relative">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                            class="img-fluid rounded shadow" 
                            alt="{{ $product->name }}">
                        </a>
                        <!-- Tombol Wishlist -->
                        <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-light btn-sm rounded-circle">
                                <i class="bi bi-heart text-danger"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Detail Produk -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-muted mb-2">{{ Str::limit($product->description, 50) }}</p>
                        <h6 class="fw-bold text-primary mb-3">Rp {{ number_format($product->price,0,',','.') }}</h6>
                        
                        <!-- Tombol Cart -->
                        <form action="{{ route('cart.store') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
