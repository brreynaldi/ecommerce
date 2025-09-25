@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container">
    <h2 class="mb-4">🛍️ Riwayat Pesanan</h2>

    @if($orders->isEmpty())
        <div class="alert alert-warning">Belum ada pesanan.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->product->name ?? '-' }}</td>
                                <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination jika pakai paginate() --}}
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
