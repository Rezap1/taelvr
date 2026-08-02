@extends('layouts.admin')

@section('title', 'Detail Jadwal PMB')

@section('breadcrumb')
    <h4 class="mb-0">Jadwal PMB</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.jadwal-pmb.index') }}">Jadwal PMB</a></li>
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
                    <i class="fas fa-calendar-alt fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $item->kegiatan }}</h5>
                <p class="text-muted mb-3"><span class="badge bg-secondary">{{ $item->gelombang }}</span></p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <x-admin.status-badge :active="$item->is_active" />
                    <span class="badge bg-light text-dark border">Urutan: {{ $item->urutan }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.jadwal-pmb.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.jadwal-pmb.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0">Informasi Metadata</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Oleh:</small> {{ $item->creator->name ?? 'System' }}</li>
                    <li class="mb-2"><small class="text-muted d-block">Dibuat Pada:</small> {{ $item->created_at->format('d M Y, H:i') }}</li>
                    <li class="mb-0"><small class="text-muted d-block">Diupdate Pada:</small> {{ $item->updated_at->format('d M Y, H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Waktu Pelaksanaan</h6>
                <div class="mb-4">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <div class="small text-muted mb-1">Mulai</div>
                            <div class="fs-5 fw-bold text-primary">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted mb-1">Selesai</div>
                            <div class="fs-5 fw-bold text-danger">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
                
                <h6 class="fw-bold border-bottom pb-2 mb-3">Keterangan Tambahan</h6>
                <div class="mb-0">
                    {!! nl2br(e($item->keterangan ?? 'Tidak ada keterangan tambahan.')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
