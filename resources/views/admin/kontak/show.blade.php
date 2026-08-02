@extends('layouts.admin')

@section('title', 'Detail Kontak')

@section('breadcrumb')
    <h4 class="mb-0">Kontak Fakultas</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kontak.index') }}">Kontak</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-body text-center pt-4">
                @php
                    $iconClass = 'fa-info-circle text-secondary';
                    if($item->type == 'alamat') $iconClass = 'fa-map-marker-alt text-danger';
                    if($item->type == 'telepon') $iconClass = 'fa-phone-alt text-primary';
                    if($item->type == 'email') $iconClass = 'fa-envelope text-warning';
                    if($item->type == 'whatsapp') $iconClass = 'fa-whatsapp text-success';
                    if($item->type == 'fax') $iconClass = 'fa-fax text-info';
                    
                    if($item->icon) $iconClass = $item->icon . ' text-dark';
                @endphp
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="{{ strpos($iconClass, 'fa-') !== false ? $iconClass : 'fas '.$iconClass }} fs-1"></i>
                </div>
                
                <h5 class="fw-bold mb-2">{{ $item->label }}</h5>
                <p class="text-muted mb-3"><span class="badge bg-secondary">{{ ucfirst($item->type) }}</span></p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <x-admin.status-badge :active="$item->is_active" />
                    <span class="badge bg-light text-dark border">Urutan: {{ $item->urutan }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.kontak.edit', $item->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit Data</a>
                    <a href="{{ route('admin.kontak.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
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
                <h6 class="fw-bold border-bottom pb-2 mb-3">Nilai / Isi Kontak</h6>
                <div class="mb-4 fs-5">
                    @if($item->type == 'email')
                        <a href="mailto:{{ $item->nilai }}">{{ $item->nilai }}</a>
                    @elseif($item->type == 'telepon')
                        <a href="tel:{{ $item->nilai }}">{{ $item->nilai }}</a>
                    @elseif($item->type == 'whatsapp')
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->nilai) }}" target="_blank">{{ $item->nilai }}</a>
                    @else
                        {!! nl2br(e($item->nilai)) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
