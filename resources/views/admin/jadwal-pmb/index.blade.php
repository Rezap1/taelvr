@extends('layouts.admin')

@section('title', 'Jadwal PMB')

@section('breadcrumb')
    <h4 class="mb-0">Jadwal PMB</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal PMB</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Jadwal Penerimaan Mahasiswa Baru</h5>
        <div>
            <a href="{{ route('admin.jadwal-pmb.trash') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-trash-alt me-1"></i> Trash
            </a>
            <a href="{{ route('admin.jadwal-pmb.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Jadwal
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.jadwal-pmb.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari kegiatan atau gelombang..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
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
                        <th>Gelombang</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td><span class="badge bg-primary">{{ $item->gelombang }}</span></td>
                            <td><div class="fw-bold">{{ $item->kegiatan }}</div></td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} 
                                @if($item->tanggal_mulai != $item->tanggal_selesai)
                                    - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                @endif
                            </td>
                            <td>
                                <x-admin.status-badge :active="$item->is_active" />
                            </td>
                            <td class="text-end">
                                <x-admin.action-buttons :id="$item->id" routePrefix="admin.jadwal-pmb" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data jadwal PMB.</td>
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
