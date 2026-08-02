@extends('layouts.admin')

@section('title', 'System & Backup')

@section('breadcrumb')
    <h4 class="mb-0">System</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">System & Backup</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card card-modern border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                <h6 class="fw-bold mb-0 text-primary"><i class="fas fa-server me-2"></i>Informasi Environment</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-medium" width="40%">Laravel Version</td>
                            <td class="pe-4 text-end text-muted">{{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">PHP Version</td>
                            <td class="pe-4 text-end text-muted">{{ phpversion() }}</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Environment</td>
                            <td class="pe-4 text-end text-muted">
                                <span class="badge bg-{{ app()->environment('production') ? 'success' : 'warning' }}">
                                    {{ ucfirst(app()->environment()) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Debug Mode</td>
                            <td class="pe-4 text-end text-muted">
                                @if(config('app.debug'))
                                    <span class="badge bg-danger">Aktif</span>
                                @else
                                    <span class="badge bg-success">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium border-0">Timezone</td>
                            <td class="pe-4 text-end text-muted border-0">{{ config('app.timezone') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-modern border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                <h6 class="fw-bold mb-0 text-primary"><i class="fas fa-tools me-2"></i>System Tools</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-broom text-warning fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Clear Application Cache</h6>
                        <p class="text-muted small mb-0">Bersihkan semua cache sistem, route, config, dan view yang tersimpan.</p>
                    </div>
                    <div>
                        <form action="{{ route('admin.system.clear-cache') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-warning" onclick="return confirm('Proses ini akan merefresh cache sistem. Lanjutkan?')">Clear Cache</button>
                        </form>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-database text-info fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">Backup Database Manual</h6>
                        <p class="text-muted small mb-0">Buat backup database saat ini secara manual ke dalam format .sql</p>
                    </div>
                    <div>
                        <form action="{{ route('admin.system.backup') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-info" onclick="return confirm('Buat backup database sekarang?')">Backup DB</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">Riwayat Backup (Backup History)</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tanggal Backup</th>
                        <th>Nama File</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($backups as $backup)
                        <tr>
                            <td class="ps-4">{{ $backup->created_at->format('d M Y, H:i') }}</td>
                            <td><span class="fw-medium text-primary">{{ $backup->filename }}</span></td>
                            <td>
                                @if($backup->size)
                                    {{ number_format($backup->size / 1024, 2) }} KB
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($backup->status == 'success')
                                    <span class="badge bg-success">Berhasil</span>
                                @else
                                    <span class="badge bg-danger">Gagal</span>
                                @endif
                            </td>
                            <td>{{ $backup->creator->name ?? 'Sistem / Auto' }}</td>
                            <td class="text-end pe-4">
                                @if($backup->status == 'success')
                                    <a href="{{ route('admin.system.download-backup', $backup->id) }}" class="btn btn-sm btn-outline-primary" title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                                <form action="{{ route('admin.system.delete-backup', $backup->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus riwayat dan file backup ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat backup.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($backups->hasPages())
        <div class="card-footer bg-transparent py-3">
            {{ $backups->links() }}
        </div>
    @endif
</div>
@endsection
