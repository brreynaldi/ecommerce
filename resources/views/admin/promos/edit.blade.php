@extends('layouts.admin.admin')

@section('title', 'Edit Promo')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Promo: {{ $promo->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('promos.update', $promo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul Promo -->
            <div class="mb-3">
                <label class="form-label fw-bold">Judul Promo</label>
                <input type="text" name="title" class="form-control" value="{{ $promo->title }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ $promo->description }}</textarea>
            </div>

            <!-- Diskon -->
            <div class="mb-3">
                <label class="form-label fw-bold">Diskon (%)</label>
                <input type="number" name="discount_percent" class="form-control" value="{{ $promo->discount_percent }}" step="0.01" min="0" max="100" required>
            </div>

            <!-- Periode -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $promo->start_date }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Berakhir</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $promo->end_date }}">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="active" class="form-select">
                    <option value="1" {{ $promo->active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$promo->active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('promos.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Update Promo</button>
            </div>
        </form>
    </div>
</div>
@endsection
