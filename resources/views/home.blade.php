@extends('layouts.app')

@section('title', 'Beranda - Linea Bridal')

@section('content')
  <!-- Hero Section -->
  <div class="hero text-white text-center">
    <h1>Temukan Jasa & Produk Terbaik</h1>
    <p class="lead">Dari ide hingga produk jadi – Semua bisa kami wujudkan untuk Anda!</p>
    <a href="#produk" class="btn btn-lg btn-warning mt-3">Belanja Sekarang</a>
  </div>

  <!-- Filter Produk -->
  <div class="container my-4">
    <form method="GET" action="{{ route('home') }}" class="d-flex justify-content-between align-items-center flex-wrap">
      <h4 class="fw-bold mb-3 mb-md-0">Filter & Sortir Produk</h4>
      <div>
        <select name="sort" class="form-select d-inline-block w-auto me-2" onchange="this.form.submit()">
          <option value="">Urutkan</option>
          <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
          <option value="low-high" {{ request('sort') == 'low-high' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
          <option value="high-low" {{ request('sort') == 'high-low' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
          <option value="bestseller" {{ request('sort') == 'bestseller' ? 'selected' : '' }}>Terlaris</option>
        </select>
        <select name="category" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
          <option value="">Semua Kategori</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
    </form>
  </div>
<!-- Produk Section -->
<div class="container my-5" id="produk">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Produk & Jasa Populer</h2>
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">
      Lihat Semua
    </a>
  </div>

  <!-- Scroll horizontal -->
  <div class="d-flex flex-row overflow-auto gap-3 pb-3">
    @forelse($products->take(5) as $product)
      <div class="card product-card shadow-sm border-0 rounded-3 position-relative" style="min-width:220px; max-width:220px;">
        
        <!-- Gambar Produk -->
        <a href="{{ route('products.show', $product->id) }}" class="product-img-wrapper">
          <img 
          src="{{ $product->image ? asset('storage/' . $product->image) : url('https://picsum.photos/1600/600?random=1') }}" 
          class="product-img" 
          alt="{{ $product->name }}">
        </a>

        <!-- Tombol Wishlist -->
        <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-2">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Tambah ke Wishlist">
            <i class="bi bi-heart text-danger"></i>
          </button>
        </form>

        <!-- Detail Produk -->
        <div class="card-body d-flex flex-column p-2">
          <h6 class="card-title fw-bold mb-1 text-truncate">{{ $product->name }}</h6>
          <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 45) }}</p>
          <h6 class="fw-bold text-primary mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>

          <!-- Tombol aksi -->
          <div class="d-flex gap-2 mt-auto">
            <form action="{{ route('cart.store') }}" method="POST" class="flex-grow-1">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                <i class="bi bi-cart-plus"></i>
              </button>
            </form>
            <a href="{{ route('checkout.product', $product->id) }}" class="btn btn-success btn-sm">
              Beli
            </a>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">Produk belum tersedia.</p>
    @endforelse
  </div>
</div>
<!-- Promo Section -->
@if(isset($promos) && $promos->count() > 0)
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="fw-bold text-danger">🔥 Promo Spesial</h2>
      <a href="{{ route('customer.promos.index') }}" class="btn btn-sm btn-outline-danger">
        Lihat Semua Promo
      </a>
    </div>

    <!-- Scroll horizontal -->
    <div class="d-flex flex-row overflow-auto gap-3 pb-3">
      @foreach($promos->take(5) as $promo)
        @php
          $hargaAsli = $promo->price;
          $diskon = $promo->promo?->discount_percent ?? 0;
          $hargaPromo = $diskon > 0
              ? $hargaAsli - ($hargaAsli * ($diskon / 100))
              : $hargaAsli;
        @endphp

        <div class="card product-card shadow-sm border-0 rounded-3 position-relative" style="min-width:220px; max-width:220px;">

          <!-- Gambar Produk -->
          <a href="{{ route('products.show', $promo->id) }}" class="product-img-wrapper">
            <img 
            src="{{ $promo->image ? asset('storage/' . $promo->image) : url('https://picsum.photos/1600/600?random=1') }}" 
            class="product-img" 
            alt="{{ $promo->name }}">
          </a>

          <!-- Tombol Wishlist -->
          <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-2">
            @csrf
            <input type="hidden" name="product_id" value="{{ $promo->id }}">
            <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Tambah ke Wishlist">
              <i class="bi bi-heart text-danger"></i>
            </button>
          </form>

          <!-- Detail Produk -->
          <div class="card-body d-flex flex-column p-2">
            <h6 class="card-title fw-bold mb-1 text-truncate">{{ $promo->name }}</h6>
            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($promo->description, 40) }}</p>

            <!-- Harga -->
            <div class="mt-auto">
              <div class="d-flex justify-content-between align-items-center mb-2">
                @if($diskon > 0)
                  <small class="text-muted text-decoration-line-through">
                    Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                  </small>
                  <span class="badge bg-danger">-{{ intval($diskon) }}%</span>
                @endif
              </div>
              <h6 class="fw-bold text-danger mb-2">
                Rp {{ number_format($hargaPromo, 0, ',', '.') }}
              </h6>

              <!-- Tombol -->
              <div class="d-flex gap-2">
                <form action="{{ route('cart.store') }}" method="POST" class="flex-grow-1">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $promo->id }}">
                  <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-cart-plus"></i>
                  </button>
                </form>
                <a href="{{ route('checkout.product', $promo->id) }}" class="btn btn-success btn-sm">
                  Beli
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif


  <!-- Styling -->
  <style>
    .product-card {
    transition: 0.3s ease;
  }
  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.12);
  }
  .product-img-wrapper {
    width: 100%;
    aspect-ratio: 1/1;
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
  .overflow-auto::-webkit-scrollbar {
    height: 8px;
  }
  .overflow-auto::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 4px;
  }
    .hero {
      background: url('https://picsum.photos/1600/600?random=1') center/cover no-repeat;
      padding: 100px 20px;
      border-radius: 0 0 25px 25px;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
    }
    .hero h1 {
      font-size: 2.2rem;
      font-weight: bold;
    }
    .hero p {
      font-size: 1rem;
    }

    /* Card Produk */
    .product-card {
      transition: 0.3s ease;
      border-radius: 12px;
      overflow: hidden;
    }
    .product-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    /* Wrapper gambar dengan aspect ratio */
    .product-img-wrapper {
      width: 100%;
      aspect-ratio: 1/1;
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
