@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container my-4">
  <h2 class="fw-bold mb-4">Linea Bridal</h2>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      
      <!-- Alamat -->
      <div class="d-flex align-items-start mb-3">
        <i class="bi bi-geo-alt-fill text-primary fs-4 me-3"></i>
        <div>
          <h6 class="fw-bold mb-1">Alamat</h6>
          <p class="mb-0">Jl. Taman Pluit Kencana No.22</p>
        </div>
      </div>

      <!-- Telepon -->
      <div class="d-flex align-items-start mb-3">
        <i class="bi bi-telephone-fill text-success fs-4 me-3"></i>
        <div>
          <h6 class="fw-bold mb-1">Telepon</h6>
          <p class="mb-0">0851-9402-2541</p>
        </div>
      </div>
<!-- 
     
      <div class="d-flex align-items-start">
        <i class="bi bi-envelope-fill text-danger fs-4 me-3"></i>
        <div>
          <h6 class="fw-bold mb-1">Email</h6>
          <p class="mb-0">info@lineabridal.com</p>
        </div>
      </div> -->

    </div>
  </div>
</div>
<div class="container my-5">
    <h2 class="fw-bold mb-4">Hubungi Kami</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Subjek</label>
            <input type="text" name="subject" class="form-control" required value="{{ old('subject') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Pesan</label>
            <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
