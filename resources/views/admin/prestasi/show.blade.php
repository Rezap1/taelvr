@extends('layouts.admin')

@section('title', 'Detail Prestasi')

@section('breadcrumb')
    <h4 class="mb-0">Prestasi</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.prestasi.index') }}">Prestasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-warning" style="width: 80px; height: 80px;">
                    <i class="fas fa-trophy fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $prestasi->judul }}</h5>
                <p class="text-muted mb-3">{{ $prestasi->peraih ?? 'Tim/Mahasiswa Tidak Diketahui' }}</p>
                
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                    @if($prestasi->tingkat)
                        <span class="badge bg-primary">Tingkat {{ $prestasi->tingkat }}</span>
                    @endif
                    @if($prestasi->tanggal)
                        <span class="badge bg-info">{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d M Y') }}</span>
                    @endif
                    @if($prestasi->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.prestasi.edit', $prestasi->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $prestasi->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $prestasi->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $prestasi->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            @if($prestasi->gambar)
                <img src="{{ asset('storage/'.$prestasi->gambar) }}" class="card-img-top" alt="Gambar Dokumentasi" style="height: 350px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Prestasi</h6>
                <div class="mb-4">
                    {!! nl2br(e($prestasi->deskripsi ?? 'Belum ada deskripsi.')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
