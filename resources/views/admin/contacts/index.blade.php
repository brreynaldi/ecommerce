@extends('layouts.admin.admin')

@section('title', 'Pesan Contact Us')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Daftar Pesan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Subjek</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>
                        @if($contact->is_read)
                            <span class="badge bg-success">Dibaca</span>
                        @else
                            <span class="badge bg-warning">Baru</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-info">Lihat</a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada pesan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $contacts->links() }}
</div>
@endsection
