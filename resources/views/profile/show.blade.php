@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">👤 Profil Saya</h2>

    <div class="row g-4">
        <!-- Informasi Akun -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                     <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) 
                        : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0D8ABC&color=fff&size=128' }}" 
                        class="rounded-circle mb-3" width="120" height="120" alt="Avatar">

                    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-outline-danger btn-sm">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Detail Data & Edit -->
        <div class="col-md-8">
            <!-- Data Akun -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">📋 Data Akun</h5>
                    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Tanggal Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <!-- Edit Profil -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">✏️ Edit Profil</h5>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="avatar" class="form-control">
                            @if($user->avatar)
                                <small class="text-muted">Foto saat ini: <a href="{{ asset('storage/'.$user->avatar) }}" target="_blank">Lihat</a></small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Riwayat Pesanan -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">📦 Riwayat Pesanan</h5>
                    
                    @if($orders->isEmpty())
                        <p class="text-muted">Belum ada pesanan.</p>
                    @else
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->product->name ?? '-' }}</td>
                                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
