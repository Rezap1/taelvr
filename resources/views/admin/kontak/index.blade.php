@extends('layouts.admin')

@section('title', 'Kontak Fakultas')

@section('breadcrumb')
    <h4 class="mb-0">Kontak</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontak</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Kontak Fakultas</h5>
        <div>
            <a href="{{ route('admin.kontak.trash') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-trash-alt me-1"></i> Trash
            </a>
            <a href="{{ route('admin.kontak.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Kontak
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.kontak.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Cari label atau nilai..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="type">
                        <option value="">Semua Tipe</option>
                        <option value="alamat" {{ request('type') == 'alamat' ? 'selected' : '' }}>Alamat</option>
                        <option value="telepon" {{ request('type') == 'telepon' ? 'selected' : '' }}>Telepon</option>
                        <option value="email" {{ request('type') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="whatsapp" {{ request('type') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="fax" {{ request('type') == 'fax' ? 'selected' : '' }}>Fax</option>
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
                        <th>Tipe</th>
                        <th>Label</th>
                        <th>Nilai Kontak</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td>
                                @php
                                    $iconClass = 'fa-info-circle text-secondary';
                                    if($item->type == 'alamat') $iconClass = 'fa-map-marker-alt text-danger';
                                    if($item->type == 'telepon') $iconClass = 'fa-phone-alt text-primary';
                                    if($item->type == 'email') $iconClass = 'fa-envelope text-warning';
                                    if($item->type == 'whatsapp') $iconClass = 'fa-whatsapp text-success';
                                    if($item->type == 'fax') $iconClass = 'fa-fax text-info';
                                @endphp
                                <span class="badge bg-light text-dark border">
                                    <i class="fas {{ $iconClass }} me-1"></i> {{ ucfirst($item->type) }}
                                </span>
                            </td>
                            <td><div class="fw-bold">{{ $item->label }}</div></td>
                            <td>{{ Str::limit(strip_tags($item->nilai), 50) }}</td>
                            <td>
                                <x-admin.status-badge :active="$item->is_active" />
                            </td>
                            <td class="text-end">
                                <x-admin.action-buttons :id="$item->id" routePrefix="admin.kontak" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data kontak.</td>
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
