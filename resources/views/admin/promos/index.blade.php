@extends('layouts.admin.admin')

@section('title', 'Promo List')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Promo</h3>
        <a href="{{ route('promos.create') }}" class="btn btn-primary">+ Tambah Promo</a>
    </div>
    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Diskon</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promos as $promo)
                <tr>
                    <td>{{ $promo->title }}</td>
                    <td>{{ $promo->discount_percent }}%</td>
                    <td>{{ $promo->start_date }} - {{ $promo->end_date }}</td>
                    <td>
                        <span class="badge {{ $promo->active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $promo->active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('promos.edit', $promo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('promos.destroy', $promo->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Yakin hapus promo ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $promos->links() }}
        </div>
    </div>
</div>
@endsection
