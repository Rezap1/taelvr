@extends('layouts.admin')

@section('title', 'Detail Kategori Galeri')

@section('breadcrumb')
    <h4 class="mb-0">Kategori Galeri</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori-galeri.index') }}">Kategori Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-secondary" style="width: 80px; height: 80px;">
                    <i class="fas fa-tags fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $kategori_galeri->nama }}</h5>
                <p class="text-muted mb-3"><code>{{ $kategori_galeri->slug }}</code></p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    @if($kategori_galeri->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @endif
                    <span class="badge bg-secondary">Urutan: {{ $kategori_galeri->urutan }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.kategori-galeri.edit', $kategori_galeri->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.kategori-galeri.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $kategori_galeri->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $kategori_galeri->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $kategori_galeri->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Kategori</h6>
                <div class="mb-4">
                    {!! nl2br(e($kategori_galeri->deskripsi ?? 'Belum ada deskripsi.')) !!}
                </div>
                
                <h6 class="fw-bold border-bottom pb-2 mb-3 mt-4">Statistik Penggunaan</h6>
                <div class="alert alert-info border-0">
                    <i class="fas fa-info-circle me-2"></i> Kategori ini digunakan oleh <strong>{{ $kategori_galeri->galeri()->count() }}</strong> item galeri foto.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
