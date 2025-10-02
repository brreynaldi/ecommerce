@extends('layouts.app')

@section('title', 'Notifikasi - Linea Bridal')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">Notifikasi</h2>

    <form method="POST" action="{{ route('notifications.readAll') }}" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-primary">
            Tandai semua sudah dibaca
        </button>
    </form>

    <div class="list-group">
        @forelse($notifications as $notification)
            <div class="list-group-item d-flex justify-content-between align-items-center 
                {{ $notification->read_at ? '' : 'bg-light' }}">
                <div>
                    <div>{{ $notification->data['message'] ?? 'Notifikasi baru' }}</div>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if(!$notification->read_at)
                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Tandai Dibaca</button>
                </form>
                @endif
            </div>
        @empty
            <div class="alert alert-info">Belum ada notifikasi.</div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
