@extends('layouts.admin')

@section('title', 'Detail Informasi PMB')

@section('breadcrumb')
    <h4 class="mb-0">Informasi PMB</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.informasi-pmb.index') }}">Informasi PMB</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-info" style="width: 80px; height: 80px;">
                    <i class="fas fa-bullhorn fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $item->judul }}</h5>
                <p class="text-muted mb-3"><code>{{ $item->slug }}</code></p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <x-admin.status-badge :active="$item->is_active" />
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.informasi-pmb.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.informasi-pmb.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Pendaftaran</h6>
            </div>
            <div class="card-body">
                @if($item->link_pendaftaran)
                    <div class="alert alert-info mb-0">
                        <strong>Link Pendaftaran Eksternal:</strong><br>
                        <a href="{{ $item->link_pendaftaran }}" target="_blank">{{ $item->link_pendaftaran }}</a>
                    </div>
                @else
                    <p class="text-muted mb-0">Tidak ada link pendaftaran eksternal.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Umum</h6>
                <div class="mb-4 text-justify">
                    {!! $item->deskripsi ?? '<p class="text-muted">Belum ada deskripsi.</p>' !!}
                </div>
                
                <h6 class="fw-bold border-bottom pb-2 mb-3">Persyaratan</h6>
                <div class="mb-4 text-justify">
                    {!! $item->persyaratan ?? '<p class="text-muted">Belum ada persyaratan.</p>' !!}
                </div>
                
                <h6 class="fw-bold border-bottom pb-2 mb-3">Alur Pendaftaran</h6>
                <div class="mb-0 text-justify">
                    {!! $item->alur_pendaftaran ?? '<p class="text-muted">Belum ada alur pendaftaran.</p>' !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
