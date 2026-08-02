@extends('layouts.admin')

@section('title', 'Tong Sampah - Kategori Galeri')

@section('breadcrumb')
    <h4 class="mb-0">Kategori Galeri (Trash)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori-galeri.index') }}">Kategori Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trash</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-trash-alt me-2"></i>Data Terhapus</h5>
        <div>
            <a href="{{ route('admin.kategori-galeri.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i> Data di bawah ini adalah data yang telah dihapus (Soft Delete). Anda bisa memulihkannya kembali atau menghapusnya secara permanen.
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th>Dihapus Pada</th>
                        <th>Dihapus Oleh</th>
                        <th width="20%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="fw-bold">{{ $item->nama }}</div>
                            </td>
                            <td>{{ $item->deleted_at->format('d M Y, H:i') }}</td>
                            <td>{{ $item->deleter->name ?? 'System' }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.kategori-galeri.restore', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Kembalikan data ini ke daftar utama?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success" title="Restore"><i class="fas fa-undo me-1"></i> Restore</button>
                                </form>
                                <form action="{{ route('admin.kategori-galeri.force-delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('PERINGATAN! Menghapus kategori ini secara permanen dapat menyebabkan error pada foto galeri yang menggunakannya jika tidak ditangani dengan benar. Lanjutkan?')">
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
