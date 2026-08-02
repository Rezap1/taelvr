@extends('layouts.admin')

@section('title', 'Manajemen Menu')

@section('breadcrumb')
    <h4 class="mb-0">Menu</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen Menu</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Manajemen Menu</h5>
        <div>
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Menu
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.menus.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari judul menu..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="type">
                        <option value="">Semua Tipe</option>
                        <option value="header" {{ request('type') == 'header' ? 'selected' : '' }}>Header / Navbar</option>
                        <option value="footer" {{ request('type') == 'footer' ? 'selected' : '' }}>Footer</option>
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
                        <th width="5%">Urutan</th>
                        <th>Tipe</th>
                        <th>Judul Menu</th>
                        <th>URL Tujuan</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->order }}</td>
                            <td>
                                <span class="badge bg-{{ $item->type == 'header' ? 'primary' : 'secondary' }}">{{ ucfirst($item->type) }}</span>
                            </td>
                            <td>
                                @if($item->parent_id)
                                    <span class="text-muted ms-3">↳ </span>
                                @endif
                                @if($item->icon)
                                    <i class="{{ strpos($item->icon, 'fa-') !== false ? $item->icon : 'fas '.$item->icon }} me-1 text-muted"></i>
                                @endif
                                <span class="fw-bold">{{ $item->title }}</span>
                            </td>
                            <td><a href="{{ $item->url }}" target="_blank">{{ Str::limit($item->url, 40) }}</a></td>
                            <td>
                                <x-admin.status-badge :active="$item->is_active" />
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.menus.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.menus.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data menu.</td>
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
