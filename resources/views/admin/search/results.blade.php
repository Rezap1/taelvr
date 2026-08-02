@extends('layouts.admin')

@section('title', 'Hasil Pencarian')

@section('breadcrumb')
    <h4 class="mb-0">Pencarian</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Search</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm mb-4">
    <div class="card-body py-4">
        <h5 class="fw-bold mb-1">Hasil Pencarian untuk: <span class="text-primary">"{{ $keyword }}"</span></h5>
        <p class="text-muted mb-0">Ditemukan {{ $results->count() }} hasil dari seluruh modul CMS.</p>
    </div>
</div>

<div class="row g-4">
    @forelse($results as $result)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm border-top border-3 border-primary hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                            <i class="fas {{ $result['icon'] }} me-1"></i> {{ $result['type'] }}
                        </span>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $result['title'] }}</h5>
                    <p class="text-muted small mb-4">{{ $result['description'] }}</p>
                    
                    <a href="{{ $result['url'] }}" class="btn btn-sm btn-outline-primary mt-auto">Lihat / Edit Data <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <i class="fas fa-search fa-3x text-muted mb-3 opacity-25"></i>
                    <h5 class="fw-bold text-muted">Tidak ada hasil ditemukan</h5>
                    <p class="text-muted mb-0">Coba gunakan kata kunci yang berbeda.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection
