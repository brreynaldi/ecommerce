@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="row w-100">
    <div class="col-12 col-md-6 col-lg-4 mx-auto">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
          <h2 class="mb-4 text-center fw-bold">Daftar Akun</h2>
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
          </form>

          <p class="text-center mt-3 mb-0">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
