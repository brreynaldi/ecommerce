@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h1>Tambah Produk</h1>

<form action="{{ route('products.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stock" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
