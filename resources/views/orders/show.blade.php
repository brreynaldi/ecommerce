@extends('layouts.app')

@section('title', 'Detail Pesanan Saya')

@section('content')
<div class="container">
    <h2 class="mb-4">🛍️ Detail Pesanan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Produk:</strong> {{ $order->product->name ?? '-' }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total,0,',','.') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
            </p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>

            @if($order->shipping_cost > 0)
                <p><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost,0,',','.') }}</p>
            @endif

            @if($order->tracking_number)
                <p><strong>No Resi:</strong> {{ $order->tracking_number }}</p>
            @endif
        </div>
    </div>

    {{-- Tombol Konfirmasi Pembayaran --}}
    @if($order->status === 'waiting_payment')
        <form action="{{ route('orders.confirmPayment', $order->id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-success">✅ Saya Sudah Bayar</button>
        </form>
    @endif
</div>
@endsection
