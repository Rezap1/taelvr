@extends('layouts.admin')

@section('title', 'Detail Program Studi')

@section('breadcrumb')
    <h4 class="mb-0">Program Studi</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.program-studi.index') }}">Program Studi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                @if($programStudi->icon)
                    <img src="{{ asset('storage/'.$programStudi->icon) }}" alt="Icon" class="mb-3 rounded" style="width: 100px; height: 100px; object-fit: contain;">
                @else
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 text-muted" style="width: 100px; height: 100px;">
                        <i class="fas fa-graduation-cap fs-1"></i>
                    </div>
                @endif
                
                <h5 class="fw-bold mb-1">{{ $programStudi->nama }}</h5>
                <p class="text-muted">{{ $programStudi->kode ?? '-' }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-primary">{{ $programStudi->jenjang }}</span>
                    @if($programStudi->akreditasi)
                        <span class="badge bg-info">Akreditasi {{ $programStudi->akreditasi }}</span>
                    @endif
                    @if($programStudi->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.program-studi.edit', $programStudi->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.program-studi.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Urutan Tampil:</small> {{ $programStudi->urutan }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $programStudi->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $programStudi->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $programStudi->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            @if($programStudi->gambar)
                <img src="{{ asset('storage/'.$programStudi->gambar) }}" class="card-img-top" alt="Cover" style="height: 250px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi</h6>
                <div class="mb-4">
                    {!! nl2br(e($programStudi->deskripsi ?? 'Belum ada deskripsi.')) !!}
                </div>
                
                <h6 class="fw-bold border-bottom pb-2 mb-3">Prospek Karir</h6>
                <div class="mb-4">
                    {!! nl2br(e($programStudi->prospek_karir ?? 'Belum ada prospek karir.')) !!}
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="bg-light rounded p-3 text-center">
                            <h6 class="text-muted mb-1">Kuota Penerimaan</h6>
                            <h4 class="mb-0 fw-bold">{{ $programStudi->kuota ?? '-' }} <small class="fs-6 fw-normal">Mahasiswa</small></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
