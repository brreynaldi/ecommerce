@extends('layouts.app')

@section('title', 'Promo Spesial - JasaKu')

@section('content')
<div class="container my-5">
  <h2 class="fw-bold text-danger mb-4 text-center">🔥 Semua Promo Spesial</h2>
  <div class="row g-3">
    @forelse($promos as $promo)
      @php
        $hargaAsli = $promo->price;
        $diskon = $promo->promo?->discount_percent ?? 0;
        $hargaPromo = $diskon > 0
            ? $hargaAsli - ($hargaAsli * ($diskon / 100))
            : $hargaAsli;
      @endphp

      <div class="col-6 col-md-3">
        <div class="card product-card shadow-sm border-0 rounded-3 position-relative">

          <!-- Gambar -->
          <a href="{{ route('products.show', $promo->id) }}" class="product-img-wrapper">
            <img src="{{ asset('storage/' . $promo->image) }}" class="product-img" alt="{{ $promo->name }}">
          </a>

          <!-- Wishlist -->
          <form action="{{ route('wishlist.store') }}" method="POST" class="position-absolute top-0 end-0 m-2">
            @csrf
            <input type="hidden" name="product_id" value="{{ $promo->id }}">
            <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Tambah ke Wishlist">
              <i class="bi bi-heart text-danger"></i>
            </button>
          </form>

          <!-- Detail -->
          <div class="card-body d-flex flex-column p-2">
            <h6 class="card-title fw-bold mb-1 text-truncate">{{ $promo->name }}</h6>
            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($promo->description, 50) }}</p>

            <div class="mt-auto">
              @if($diskon > 0)
                <small class="text-muted text-decoration-line-through">
                  Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                </small>
                <span class="badge bg-danger">-{{ intval($diskon) }}%</span>
              @endif
              <h6 class="fw-bold text-danger">
                Rp {{ number_format($hargaPromo, 0, ',', '.') }}
              </h6>
              <div class="d-flex gap-2 mt-2">
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
      </div>
    @empty
      <p class="text-center">Belum ada promo tersedia.</p>
    @endforelse
  </div>

  <div class="mt-4">
    {{ $promos->links() }}
  </div>
</div>
@endsection
