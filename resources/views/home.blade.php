@extends('layouts.app')

@section('title', 'Beranda - JasaKu')

@section('content')
  <!-- Hero -->
  <div class="hero text-white text-center p-5" style="background: url('https://picsum.photos/1600/600?random=1') center/cover no-repeat;">
    <h1>Temukan Jasa & Produk Terbaik</h1>
    <p class="lead">Dari ide hingga produk jadi – Semua bisa kami wujudkan!</p>
    <a href="#produk" class="btn btn-lg btn-warning mt-3">Belanja Sekarang</a>
  </div>

  <!-- Produk -->
  <div class="container my-5" id="produk">
    <h2 class="text-center fw-bold mb-4">Produk & Jasa Populer</h2>
    <div class="row g-4">
      @foreach($products as $product)
        <div class="col-6 col-md-3">
          <div class="card h-100 shadow-sm border-0 product-card d-flex flex-column">
            
            <!-- Gambar Produk -->
            <div class="position-relative">
              <a href="{{ route('products.show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     class="card-img-top img-fluid w-100 rounded" 
                     alt="{{ $product->name }}">
              </a>
              <!-- Tombol Wishlist -->
              <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm">
                  <i class="bi bi-heart text-danger"></i>
                </button>
              </form>
            </div>

            <!-- Tombol Cart di bawah gambar -->
            <div class="p-2">
              <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-outline-primary w-100">
                  <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                </button>
              </form>
            </div>

            <!-- Detail Produk -->
            <div class="card-body d-flex flex-column">
              <h6 class="card-title fw-bold">{{ $product->name }}</h6>
              <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 60) }}</p>
              <h6 class="fw-bold text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
              
              <!-- Tombol Beli di bawah card -->
              <div class="mt-auto">
                <a href="{{ route('checkout.product', $product->id) }}" class="btn btn-success w-100">
                  <i class="bi bi-bag-check me-1"></i> Beli Sekarang
                </a>
              </div>
            </div>

          </div>
        </div>
      @endforeach
    </div>
  </div>

  <style>
    .product-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .product-card img {
      object-fit: contain; /* gambar tampil full tanpa crop */
      background: #fff;
      border-bottom: 1px solid #eee;
    }
  </style>
@endsection
    