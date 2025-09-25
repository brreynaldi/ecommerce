@extends('layouts.app')

@section('title', 'Keranjang Saya')

@section('content')
<div class="container">
    <h2 class="mb-4">🛒 Keranjang Saya</h2>

    @if($carts->isEmpty())
        <div class="alert alert-warning">Keranjang masih kosong.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Form Checkout hanya untuk produk terpilih --}}
                <form method="GET" action="{{ route('checkout.index') }}">
                    <div class="table-responsive"> {{-- buat scroll di layar kecil --}}
                        <table class="table align-middle table-row-dashed gy-3">
                            <thead class="bg-light">
                                <tr class="fw-bold text-muted">
                                    <th class="text-center"><input type="checkbox" id="checkAll"></th>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                    @php $total = $cart->quantity * $cart->product->price; @endphp
                                    <tr data-cart-id="{{ $cart->id }}">
                                        <td class="text-center">
                                            <input type="checkbox" name="cart_id[]" value="{{ $cart->id }}" class="checkItem">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $cart->product->image 
                                                            ? asset('storage/'.$cart->product->image) 
                                                            : asset('metronic/assets/media/stock/600x400/img-1.jpg') }}" 
                                                    alt="{{ $cart->product->name }}"
                                                    class="rounded bg-light me-3"
                                                    style="width:64px; height:64px; object-fit:contain; padding:4px;">
                                                <div>
                                                    <span class="fw-bold d-block">{{ $cart->product->name }}</span>
                                                    <small class="text-muted">
                                                        Rp {{ number_format($cart->product->price,0,',','.') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-light border minus-btn">-</button>
                                                <input type="number"
                                                    value="{{ $cart->quantity }}" 
                                                    min="1"
                                                    class="form-control form-control-sm text-center qty-input"
                                                    style="width: 55px;" />
                                                <button type="button" class="btn btn-sm btn-light border plus-btn">+</button>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            Rp {{ number_format($cart->product->price,0,',','.') }}
                                        </td>
                                        <td class="text-end fw-bold total-cell">
                                            Rp {{ number_format($total,0,',','.') }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Form hapus produk, terpisah dari checkout --}}
                                            <form action="{{ route('cart.destroy', $cart->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Hapus produk ini?')"
                                                  class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success btn-lg">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

{{-- Script --}}
<script>
    // Select all checkbox
    document.getElementById('checkAll')?.addEventListener('change', function() {
        document.querySelectorAll('.checkItem').forEach(cb => cb.checked = this.checked);
    });

    // Helper update AJAX
    function updateQuantity(cartId, quantity, row) {
        fetch(`/cart/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                row.querySelector('.total-cell').textContent =
                    'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
            } else {
                alert('Gagal update keranjang!');
            }
        })
        .catch(err => console.error(err));
    }

    // Event plus / minus
    document.querySelectorAll('tr[data-cart-id]').forEach(row => {
        const cartId = row.getAttribute('data-cart-id');
        const input = row.querySelector('.qty-input');
        const minus = row.querySelector('.minus-btn');
        const plus  = row.querySelector('.plus-btn');

        minus.addEventListener('click', () => {
            let val = parseInt(input.value) || 1;
            if(val > 1) {
                val--;
                input.value = val;
                updateQuantity(cartId, val, row);
            }
        });

        plus.addEventListener('click', () => {
            let val = parseInt(input.value) || 1;
            val++;
            input.value = val;
            updateQuantity(cartId, val, row);
        });

        input.addEventListener('change', () => {
            let val = parseInt(input.value) || 1;
            if(val < 1) val = 1;
            input.value = val;
            updateQuantity(cartId, val, row);
        });
    });
</script>
@endsection
