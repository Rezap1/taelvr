@extends('layouts.admin')

@section('title', 'Detail Galeri')

@section('breadcrumb')
    <h4 class="mb-0">Galeri</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.galeri.index') }}">Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-primary" style="width: 80px; height: 80px;">
                    <i class="fas {{ $galeri->file_type == 'video' ? 'fa-video' : 'fa-image' }} fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $galeri->judul }}</h5>
                <p class="text-muted mb-3"><span class="badge bg-secondary">{{ $galeri->kategoriGaleri->nama ?? '-' }}</span></p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <x-admin.status-badge :active="$galeri->is_active" />
                    <span class="badge bg-light text-dark border">Urutan: {{ $galeri->urutan }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Tipe File:</small> {{ strtoupper($galeri->file_type) }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $galeri->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $galeri->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $galeri->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            @if($galeri->file_path)
                @if($galeri->file_type == 'image')
                    <img src="{{ asset('storage/'.$galeri->file_path) }}" class="card-img-top" alt="Gambar Galeri" style="max-height: 500px; object-fit: contain; background: #f8f9fa;">
                @elseif($galeri->file_type == 'video')
                    <video controls class="w-100" style="max-height: 500px; background: #000;">
                        <source src="{{ asset('storage/'.$galeri->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                @endif
            @endif
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi</h6>
                <div class="mb-4">
                    {!! nl2br(e($galeri->deskripsi ?? 'Belum ada deskripsi.')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
