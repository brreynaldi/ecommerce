@extends('layouts.admin.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container">
    <h2 class="mb-4">📦 Detail Pesanan</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Informasi Pesanan</h5>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>No. HP:</strong> {{ $order->phone }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
            </p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total,0,',','.') }}</p>
        </div>
    </div>

    {{-- Input Ongkir --}}
    @if($order->status === 'pending')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Tambahkan Ongkir</h5>
            <form action="{{ route('admin.orders.updateShipping', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Biaya Ongkir</label>
                    <input type="number" name="shipping_cost" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Ongkir</button>
            </form>
        </div>
    </div>
    @endif

    {{-- Update Status & Tracking --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold">Update Status</h5>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Status Pesanan</label>
                    <select name="status" class="form-select" required>
                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Diterima</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Resi</label>
                    <input type="text" name="tracking_number" class="form-control" 
                           value="{{ $order->tracking_number }}">
                </div>

                <button type="submit" class="btn btn-success">Update Pesanan</button>
            </form>
        </div>
    </div>
</div>
@endsection
