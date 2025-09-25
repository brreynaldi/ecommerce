@extends('layouts.admin.admin')

@section('title', 'Dashboard Admin')

@section('content')
  <h1>Dashboard Admin</h1>
  <p>Selamat datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>

  <div class="row">
    <div class="col-md-4">
      <div class="card text-bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Produk</h5>
          <p class="card-text">Kelola semua produk di toko.</p>
          <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">Lihat Produk</a>
        </div>
      </div>
    </div>
  </div>
@endsection
