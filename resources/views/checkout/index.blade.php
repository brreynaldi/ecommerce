@extends('layouts.app')

@section('title', 'Checkout - Linea Bridal')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">Checkout</h2>
    <div class="row g-4">
        <!-- Data Pembeli -->
        <div class="col-lg-7">
            <h5>Data Pembeli</h5>

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                {{-- Hidden input sesuai sumber checkout --}}
                @foreach($carts as $cart)
                    @if($cart->id) 
                        {{-- Jika dari keranjang --}}
                        <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                    @else
                        {{-- Jika dari 1 produk --}}
                        <input type="hidden" name="product_id" value="{{ $cart->product->id }}">
                        <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
                    @endif
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" placeholder="+62..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="bank">Transfer Bank</option>
                        <option value="ovo">OVO</option>
                        <option value="dana">DANA</option>
                        <option value="gopay">GoPay</option>
                        <option value="cod">COD</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 btn-lg">Konfirmasi & Bayar</button>
            </form>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-5">
            <h5>Ringkasan Pesanan</h5>
            <div class="border rounded p-3 mb-3">
                @php $grandTotal = 0; @endphp

                @foreach($carts as $cart)
                    @php
                        $unitPrice = $cart->product->final_price ?? $cart->product->price;
                        $lineTotal = $unitPrice * $cart->quantity;
                        $grandTotal += $lineTotal;
                    @endphp

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img
                                src="{{ $cart->product->image
                                        ? asset('storage/'.$cart->product->image)
                                        : asset('metronic/assets/media/stock/600x400/img-1.jpg') }}"
                                alt="{{ $cart->product->name }}"
                                class="rounded bg-light me-3"
                                style="width:64px;height:64px;object-fit:contain;">
                            <div>
                                <div class="fw-semibold">{{ $cart->product->name }}</div>
                                <small class="text-muted">x{{ $cart->quantity }}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            Rp {{ number_format($lineTotal, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
                <small class="text-muted d-block mt-1">Ongkir akan ditambahkan oleh admin.</small>
            </div>
        </div>
    </div>
</div>
@endsection
