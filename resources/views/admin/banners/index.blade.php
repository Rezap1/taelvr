@extends('layouts.admin')

@section('title', 'Banner & Hero Slider')

@section('breadcrumb')
    <h4 class="mb-0">Banner</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Banner & Hero</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Manajemen Banner</h5>
        <div>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Banner
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.banners.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari judul banner..." value="{{ request('search') }}">
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
                        <th width="5%">Urutan</th>
                        <th width="20%">Gambar</th>
                        <th>Info Banner</th>
                        <th>Jadwal Tayang</th>
                        <th>Status</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->urutan }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="img-thumbnail" style="max-height: 80px; width: auto;">
                            </td>
                            <td>
                                <div class="fw-bold">{{ $item->title ?? 'Tanpa Judul' }}</div>
                                @if($item->subtitle)
                                    <small class="text-muted">{{ Str::limit($item->subtitle, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->start_date || $item->end_date)
                                    <small class="d-block">Mulai: {{ $item->start_date ? $item->start_date->format('d M Y, H:i') : '-' }}</small>
                                    <small class="d-block">Selesai: {{ $item->end_date ? $item->end_date->format('d M Y, H:i') : '-' }}</small>
                                @else
                                    <span class="text-muted fst-italic">Selalu Tayang</span>
                                @endif
                            </td>
                            <td>
                                <x-admin.status-badge :active="$item->is_active" />
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.banners.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus banner ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data banner.</td>
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
