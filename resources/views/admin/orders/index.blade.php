@extends('layouts.admin.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="container">
    <h2 class="mb-4">📦 Daftar Pesanan</h2>

    @if($orders->isEmpty())
        <div class="alert alert-warning">Belum ada pesanan masuk.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
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
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>{{ $order->product->name ?? '-' }}</td>
                                <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-secondary
                                        @elseif($order->status == 'waiting_payment') bg-warning
                                        @elseif($order->status == 'paid') bg-success
                                        @elseif($order->status == 'processing') bg-info
                                        @elseif($order->status == 'shipped') bg-primary
                                        @elseif($order->status == 'delivered') bg-dark
                                        @else bg-danger @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        Kelola
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
