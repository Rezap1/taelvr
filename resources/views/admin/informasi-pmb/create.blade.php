@extends('layouts.admin')

@section('title', 'Tambah Informasi PMB')

@section('breadcrumb')
    <h4 class="mb-0">Informasi PMB</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.informasi-pmb.index') }}">Informasi PMB</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Tambah Informasi PMB</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.informasi-pmb.store') }}" method="POST">
            @csrf
            
            @include('admin.informasi-pmb.form')
            
            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('admin.informasi-pmb.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
