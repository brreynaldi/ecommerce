@extends('layouts.app')

@section('title', 'Login')

@section('content')
<h2>Login</h2>
<form action="{{ route('login') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-success">Login</button>
</form>
@endsection
