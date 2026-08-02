@extends('layouts.admin')

@section('title', 'Program Studi')

@section('breadcrumb')
    <h4 class="mb-0">Program Studi</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Program Studi</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Data Program Studi</h5>
        <div>
            <a href="{{ route('admin.program-studi.trash') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-trash-alt me-1"></i> Trash
            </a>
            <a href="{{ route('admin.program-studi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.program-studi.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Cari nama / kode prodi..." value="{{ request('search') }}">
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
                        <th width="8%">Ikon</th>
                        <th>Program Studi</th>
                        <th>Jenjang</th>
                        <th>Akreditasi</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td>
                                @if($item->icon)
                                    @if(str_contains($item->icon, '.'))
                                        <img src="{{ asset('storage/'.$item->icon) }}" alt="Icon" width="40" height="40" class="rounded object-fit-cover">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-primary" style="width: 40px; height: 40px;">
                                            <i class="{{ $item->icon }} fs-5"></i>
                                        </div>
                                    @endif
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $item->nama }}</div>
                                <div class="small text-muted">{{ $item->kode ?? '-' }}</div>
                            </td>
                            <td>{{ $item->jenjang }}</td>
                            <td>
                                @if($item->akreditasi)
                                    <span class="badge bg-info">{{ $item->akreditasi }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.program-studi.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.program-studi.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.program-studi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data program studi.</td>
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
