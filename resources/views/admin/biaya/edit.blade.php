@extends('layouts.admin')

@section('title', 'Edit Biaya')

@section('breadcrumb')
    <h4 class="mb-0">Biaya Pendidikan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.biaya.index') }}">Biaya Pendidikan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Edit Biaya: {{ $item->jenis_biaya }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.biaya.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            @include('admin.biaya.form', ['item' => $item])
            
            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('admin.biaya.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
