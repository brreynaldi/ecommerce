@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')
<div class="container">
    <h2 class="mb-5">💖 Wishlist Saya</h2>

    @if($wishlists->isEmpty())
        <div class="alert alert-info">Wishlist masih kosong.</div>
    @else
        <div class="row g-6">
            @foreach($wishlists as $wishlist)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ $wishlist->product->image 
                                        ? asset('storage/' . $wishlist->product->image) 
                                        : asset('metronic/assets/media/stock/600x400/img-1.jpg') }}" 
                            alt="{{ $wishlist->product->name }}"
                            class="w-100 rounded mb-3 bg-light"
                            style="height: 200px; object-fit: contain; padding: 10px;">
                            <h5 class="fw-bold">{{ $wishlist->product->name }}</h5>
                            <p class="text-muted mb-3">Rp {{ number_format($wishlist->product->price,0,',','.') }}</p>
                            
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('wishlist.update', $wishlist->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-cart"></i> Tambah ke Keranjang
                                    </button>
                                </form>
                                <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
