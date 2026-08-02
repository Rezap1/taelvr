@extends('layouts.admin')

@section('title', 'Media Manager')

@section('breadcrumb')
    <h4 class="mb-0">Media Manager</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Media Manager</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Pusat File & Media</h5>
        <div>
            <a href="{{ route('admin.media.trash') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-trash-alt me-1"></i> Trash
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-1"></i> Upload File
            </button>
        </div>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.media.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari nama file atau judul..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="type">
                        <option value="">Semua Tipe</option>
                        <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                        <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <div class="row g-4">
            @forelse($items as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border shadow-sm">
                        <div class="position-relative bg-light rounded-top d-flex align-items-center justify-content-center" style="height: 180px; overflow: hidden;">
                            @if($item->file_type == 'image')
                                <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text ?? $item->title }}" class="w-100 h-100 object-fit-cover">
                            @elseif($item->file_type == 'video')
                                <i class="fas fa-video fa-3x text-secondary"></i>
                            @else
                                <i class="fas fa-file-alt fa-3x text-secondary"></i>
                            @endif
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge bg-dark bg-opacity-75">{{ strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION)) }}</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="text-truncate mb-1" title="{{ $item->title ?? $item->file_name }}">{{ $item->title ?? $item->file_name }}</h6>
                            <p class="small text-muted mb-3">{{ number_format($item->file_size / 1024, 2) }} KB</p>
                            
                            <div class="d-flex justify-content-between align-items-center gap-1">
                                <button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1" onclick="copyToClipboard('{{ asset('storage/'.$item->file_path) }}')" title="Copy URL">
                                    <i class="fas fa-link"></i> Copy
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Pindahkan ke tong sampah?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Detail Media</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.media.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3 text-center">
                                        @if($item->file_type == 'image')
                                            <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->alt_text ?? $item->title }}" class="img-thumbnail" style="max-height: 150px">
                                        @endif
                                        <p class="mt-2 small text-muted text-break">{{ $item->file_name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Media</label>
                                        <input type="text" class="form-control" name="title" value="{{ $item->title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alt Text (SEO)</label>
                                        <input type="text" class="form-control" name="alt_text" value="{{ $item->alt_text }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                        <p>Belum ada media yang diunggah.</p>
                    </div>
                </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Media Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>
                        <div class="form-text">Maksimal ukuran file: 20MB.</div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul (Opsional)</label>
                        <input type="text" class="form-control" name="title" placeholder="Jika dikosongkan, akan menggunakan nama file">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alt Text / Deskripsi Singkat (Opsional)</label>
                        <input type="text" class="form-control" name="alt_text">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL berhasil disalin ke clipboard!');
    }, function(err) {
        console.error('Gagal menyalin text: ', err);
    });
}
</script>
@endpush
@endsection
