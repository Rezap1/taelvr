@extends('layouts.admin')

@section('title', 'Detail Fasilitas')

@section('breadcrumb')
    <h4 class="mb-0">Fasilitas</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.fasilitas.index') }}">Fasilitas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                @if($fasilitas->icon)
                    <img src="{{ asset('storage/'.$fasilitas->icon) }}" alt="Icon" class="mb-3 rounded" style="width: 80px; height: 80px; object-fit: contain;">
                @else
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-muted" style="width: 80px; height: 80px;">
                        <i class="fas fa-building fs-1"></i>
                    </div>
                @endif
                
                <h5 class="fw-bold mb-3">{{ $fasilitas->nama }}</h5>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    @if($fasilitas->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @endif
                    <span class="badge bg-secondary">Urutan: {{ $fasilitas->urutan }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.fasilitas.edit', $fasilitas->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $fasilitas->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $fasilitas->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $fasilitas->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            @if($fasilitas->gambar)
                <img src="{{ asset('storage/'.$fasilitas->gambar) }}" class="card-img-top" alt="Gambar" style="height: 300px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Fasilitas</h6>
                <div class="mb-4">
                    {!! nl2br(e($fasilitas->deskripsi ?? 'Belum ada deskripsi.')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
