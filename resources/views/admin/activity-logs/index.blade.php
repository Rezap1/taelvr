@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('breadcrumb')
    <h4 class="mb-0">Activity Logs</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Log Aktivitas</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-3">
        <h5 class="fw-bold mb-0">Riwayat Aktivitas Admin</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <select class="form-select" name="module">
                        <option value="">Semua Modul</option>
                        @foreach($modules as $mod)
                            <option value="{{ $mod }}" {{ request('module') == $mod ? 'selected' : '' }}>{{ $mod }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="action">
                        <option value="">Semua Aksi</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Created (Tambah)</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Updated (Ubah)</option>
                        <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Deleted (Hapus)</option>
                        <option value="downloaded" {{ request('action') == 'downloaded' ? 'selected' : '' }}>Downloaded (Unduh)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>Detail Aktivitas</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $item->created_at->format('d M Y') }}</span><br>
                                <small class="text-muted">{{ $item->created_at->format('H:i:s') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                        {{ substr($item->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="font-size: 14px;">{{ $item->user->name ?? 'System' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badge = 'secondary';
                                    if(in_array($item->action, ['created', 'store'])) $badge = 'success';
                                    if(in_array($item->action, ['updated', 'edit'])) $badge = 'primary';
                                    if(in_array($item->action, ['deleted', 'destroy', 'force-delete'])) $badge = 'danger';
                                    if(in_array($item->action, ['downloaded', 'restore'])) $badge = 'info';
                                @endphp
                                <span class="badge bg-{{ $badge }} text-uppercase">{{ $item->action }}</span>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $item->module ?? 'General' }}</span></td>
                            <td>{{ $item->details }}</td>
                            <td><small class="text-muted">{{ $item->ip_address }}</small></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat aktivitas.</td>
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
