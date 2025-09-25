@extends('layouts.admin.admin') {{-- gunakan layout Metronic admin --}}

@section('title', 'Notifikasi Admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">📢 Notifikasi Admin</h3>
        <form method="POST" action="{{ route('admin.notifications.readAll') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">
                Tandai semua sudah dibaca
            </button>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle table-row-dashed fs-6 gy-4">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center" style="width:50px;">#</th>
                        <th>Pesan</th>
                        <th class="text-center" style="width:180px;">Tanggal</th>
                        <th class="text-center" style="width:120px;">Status</th>
                        <th class="text-end" style="width:200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 fw-semibold">
                    @forelse($notifications as $notification)
                        <tr class="{{ $notification->read_at ? '' : 'bg-light' }}">
                            {{-- Penomoran --}}
                            <td class="text-center">
                                {{ ($notifications->currentPage() - 1) * $notifications->perPage() + $loop->iteration }}
                            </td>

                            {{-- Pesan --}}
                            <td>
                                {{ $notification->data['message'] ?? 'Notifikasi baru' }}
                                @if(isset($notification->data['total']))
                                    <div>
                                        <small class="text-muted">
                                            Total: Rp {{ number_format($notification->data['total'], 0, ',', '.') }}
                                        </small>
                                    </div>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td class="text-center">
                                {{ $notification->created_at->format('d M Y H:i') }}
                            </td>

                            {{-- Status --}}
                            <td class="text-center">
                                @if($notification->read_at)
                                    <span class="badge badge-light-success">Dibaca</span>
                                @else
                                    <span class="badge badge-light-danger">Belum Dibaca</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-end d-flex gap-2 justify-content-end">
                             {{-- Tombol lihat detail order sekaligus tandai dibaca --}}
                                @if(isset($notification->data['order_id']))
                                    <a href="{{ route('admin.notifications.readAndGo', $notification->id) }}" 
                                    class="btn btn-sm btn-info">
                                        Lihat
                                    </a>
                                @endif

                                {{-- Tombol tandai dibaca --}}
                                @if(!$notification->read_at)
                                <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Tandai Dibaca
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">Belum ada notifikasi.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
