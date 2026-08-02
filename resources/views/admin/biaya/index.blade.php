@extends('layouts.admin')

@section('title', 'Biaya Pendidikan')

@section('breadcrumb')
    <h4 class="mb-0">Biaya Pendidikan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Biaya Pendidikan</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Biaya Pendidikan</h5>
        <div>
            <a href="{{ route('admin.biaya.trash') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-trash-alt me-1"></i> Trash
            </a>
            <a href="{{ route('admin.biaya.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Biaya
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.biaya.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Cari jenis biaya..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="prodi">
                        <option value="">Semua Program Studi</option>
                        @foreach($prodi as $p)
                            <option value="{{ $p->id }}" {{ request('prodi') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Program Studi</th>
                        <th>Jenis Biaya</th>
                        <th>Nominal</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item->programStudi->nama ?? '-' }}</span></td>
                            <td><div class="fw-bold">{{ $item->jenis_biaya }}</div></td>
                            <td class="text-primary fw-bold">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->periode ?? '-' }}</td>
                            <td>
                                <x-admin.status-badge :active="$item->is_active" />
                            </td>
                            <td class="text-end">
                                <x-admin.action-buttons :id="$item->id" routePrefix="admin.biaya" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data biaya pendidikan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
