@extends('layouts.admin')

@section('title', 'Tong Sampah - Media')

@section('breadcrumb')
    <h4 class="mb-0">Media Manager (Trash)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.media.index') }}">Media Manager</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trash</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-trash-alt me-2"></i>Media Terhapus</h5>
        <div>
            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Manager
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i> File yang dihapus permanen akan <strong>benar-benar terhapus dari server</strong> dan tidak dapat dikembalikan.
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Media</th>
                        <th>File Type</th>
                        <th>Dihapus Pada</th>
                        <th width="20%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->file_type == 'image')
                                        <img src="{{ asset('storage/'.$item->file_path) }}" alt="img" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-file"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $item->title ?? $item->file_name }}</div>
                                        <div class="small text-muted">{{ number_format($item->file_size / 1024, 2) }} KB</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary">{{ strtoupper($item->file_type) }}</span></td>
                            <td>{{ $item->deleted_at->format('d M Y, H:i') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.media.restore', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success" title="Restore"><i class="fas fa-undo me-1"></i> Restore</button>
                                </form>
                                <form action="{{ route('admin.media.force-delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('PERINGATAN! File fisik akan dihapus dari server. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Permanen"><i class="fas fa-times me-1"></i> Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tong sampah kosong.</td>
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
