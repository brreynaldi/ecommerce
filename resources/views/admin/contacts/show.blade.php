@extends('layouts.admin.admin')

@section('title', 'Detail Pesan Contact Us')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Detail Pesan</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Subjek:</strong> {{ $contact->subject }}</p>
            <p><strong>Pesan:</strong><br>{{ $contact->message }}</p>
        </div>
    </div>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
