@extends('layouts.admin')

@section('title', 'Edit Prestasi')

@section('breadcrumb')
    <h4 class="mb-0">Prestasi</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.prestasi.index') }}">Prestasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Edit Prestasi: {{ Str::limit($prestasi->judul, 40) }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('admin.prestasi.form', ['item' => $prestasi])
            
            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
