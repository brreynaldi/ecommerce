@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container my-5">
    <h2 class="mb-5 fw-bold text-center">🛍️ Daftar Produk</h2>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card h-100 shadow-sm border-0 rounded-3 position-relative">

                    <!-- Gambar Produk -->
                    <a href="{{ route('products.show', $product->id) }}" class="product-img-wrapper">
                        <img 
                            src="{{ $product->image ? asset('storage/' . $product->image) : url('https://picsum.photos/1600/600?random=1') }}" 
                            class="product-img" 
                            alt="{{ $product->name }}">
                    </a>

                    <!-- Tombol Wishlist -->
                    <form action="{{ route('wishlist.store') }}" method="POST" 
                          class="position-absolute top-0 end-0 m-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Tambah ke Wishlist">
                            <i class="bi bi-heart text-danger"></i>
                        </button>
                    </form>

                    <!-- Detail Produk -->
                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="card-title fw-bold mb-1 text-truncate">{{ $product->name }}</h6>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($product->description, 45) }}
                        </p>
                        <h6 class="fw-bold text-primary mb-3">Rp {{ number_format($product->price,0,',','.') }}</h6>

                        <!-- Tombol Cart -->
                        <form action="{{ route('cart.store') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-outline-primary w-100 btn-sm">
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

<!-- Styling -->
<style>
    .product-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .product-img-wrapper {
        width: 100%;
        aspect-ratio: 1/1; /* Biar kotak */
        overflow: hidden;
        display: block;
        background: #fff;
    }
    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .product-img-wrapper:hover .product-img {
        transform: scale(1.08);
    }
</style>
@endsection
