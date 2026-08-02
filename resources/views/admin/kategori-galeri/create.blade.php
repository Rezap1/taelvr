@extends('layouts.admin')

@section('title', 'Tambah Kategori Galeri')

@section('breadcrumb')
    <h4 class="mb-0">Kategori Galeri</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori-galeri.index') }}">Kategori Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Tambah Kategori Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kategori-galeri.store') }}" method="POST">
            @csrf
            
            @include('admin.kategori-galeri.form')
            
            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('admin.kategori-galeri.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
