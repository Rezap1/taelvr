@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="page-header">
        <h4>Dashboard</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')

{{-- Welcome Banner --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0" style="background: linear-gradient(135deg, #0F172A 0%, #1E40AF 70%, #2563EB 100%); border-radius: 16px; overflow: hidden;">
            <div class="card-body p-4 position-relative" style="z-index:1;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <p style="color:rgba(255,255,255,0.75);font-size:0.8rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:0.5rem;">
                            <i class="fas fa-tachometer-alt me-2"></i>Pusat Kontrol Admin
                        </p>
                        <h3 style="color:#ffffff;font-weight:800;font-size:1.6rem;margin-bottom:0.5rem;">
                            Selamat datang, {{ auth()->user()->name }}! 👋
                        </h3>
                        <p style="color:rgba(255,255,255,0.85);font-size:0.95rem;margin:0;line-height:1.6;">
                            Kelola konten dan pengaturan website Fakultas Teknik UNSUR dari sini.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('home') }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:#2563EB;padding:10px 22px;border-radius:8px;font-weight:700;font-size:0.88rem;text-decoration:none;transition:all 0.2s;">
                            <i class="fas fa-external-link-alt"></i> Lihat Website
                        </a>
                    </div>
                </div>
                {{-- Decorative circle --}}
                <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.06);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-60px;right:120px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.04);pointer-events:none;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-wrap" style="background:#EFF6FF;">
                    <i class="fas fa-graduation-cap" style="color:#2563EB;"></i>
                </div>
                <span class="stat-badge">Akademik</span>
            </div>
            <div class="stat-number">{{ $stats['program_studi'] }}</div>
            <p class="stat-title">Program Studi</p>
            <a href="{{ route('admin.program-studi.index') }}" class="stat-link">
                Kelola Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-wrap" style="background:#F0FDF4;">
                    <i class="fas fa-building" style="color:#16A34A;"></i>
                </div>
                <span class="stat-badge">Infrastruktur</span>
            </div>
            <div class="stat-number">{{ $stats['fasilitas'] }}</div>
            <p class="stat-title">Total Fasilitas</p>
            <a href="{{ route('admin.fasilitas.index') }}" class="stat-link">
                Kelola Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-wrap" style="background:#FEFCE8;">
                    <i class="fas fa-trophy" style="color:#CA8A04;"></i>
                </div>
                <span class="stat-badge">Mahasiswa</span>
            </div>
            <div class="stat-number">{{ $stats['prestasi'] }}</div>
            <p class="stat-title">Total Prestasi</p>
            <a href="{{ route('admin.prestasi.index') }}" class="stat-link">
                Kelola Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon-wrap" style="background:#F0F9FF;">
                    <i class="fas fa-images" style="color:#0284C7;"></i>
                </div>
                <span class="stat-badge">Publikasi</span>
            </div>
            <div class="stat-number">{{ $stats['galeri'] }}</div>
            <p class="stat-title">Total Galeri</p>
            <a href="{{ route('admin.galeri.index') }}" class="stat-link">
                Kelola Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- Chart & Storage --}}
<div class="row g-3 mb-4">
    <div class="col-xl-8">
        <div class="card h-100">
            <div class="card-header">
                <h6>Statistik Aktivitas Admin (7 Hari Terakhir)</h6>
            </div>
            <div class="card-body">
                <canvas id="activityChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-header">
                <h6>Media &amp; Penyimpanan</h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-center text-center">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:72px;height:72px;border-radius:16px;background:#EFF6FF;">
                        <i class="fas fa-database" style="font-size:2rem;color:#2563EB;"></i>
                    </div>
                    <div style="font-size:2rem;font-weight:800;color:#0F172A;line-height:1;">
                        {{ number_format($mediaStorage / 1024 / 1024, 2) }} MB
                    </div>
                    <p style="color:#64748B;font-weight:600;font-size:0.85rem;margin-top:4px;">Kapasitas Media Terpakai</p>
                </div>
                <div class="row border-top pt-3">
                    <div class="col-6 border-end text-center">
                        <div style="font-size:1.5rem;font-weight:800;color:#0F172A;">{{ $stats['media'] }}</div>
                        <div style="color:#64748B;font-weight:600;font-size:0.8rem;">Total File</div>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.media.index') }}" class="btn btn-primary btn-sm px-3">Kelola Media</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Activity & Login Logs --}}
<div class="row g-3">
    <div class="col-xl-8">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6>Aktivitas Terkini</h6>
                <a href="{{ route('admin.activity-logs.index') }}"
                   style="font-size:0.8rem;font-weight:700;color:#2563EB;text-decoration:none;">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                        @forelse($recentActivities as $activity)
                            <tr>
                                <td style="padding:1rem;width:50px;">
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="width:36px;height:36px;border-radius:8px;
                                         background:{{ $activity->action == 'created' ? '#F0FDF4' : ($activity->action == 'updated' ? '#EFF6FF' : '#FEF2F2') }}">
                                        @if($activity->action == 'created')
                                            <i class="fas fa-plus" style="color:#16A34A;font-size:0.8rem;"></i>
                                        @elseif($activity->action == 'updated')
                                            <i class="fas fa-edit" style="color:#2563EB;font-size:0.8rem;"></i>
                                        @elseif($activity->action == 'deleted')
                                            <i class="fas fa-trash" style="color:#DC2626;font-size:0.8rem;"></i>
                                        @else
                                            <i class="fas fa-info" style="color:#0284C7;font-size:0.8rem;"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight:700;color:#0F172A;font-size:0.875rem;">{{ $activity->user->name ?? 'Sistem' }}</div>
                                    <div style="color:#64748B;font-size:0.8rem;">
                                        {{ $activity->details }}
                                        <span style="background:#F1F5F9;color:#475569;font-size:0.72rem;font-weight:700;padding:2px 8px;border-radius:20px;margin-left:4px;display:inline-block;">
                                            {{ $activity->module }}
                                        </span>
                                    </div>
                                </td>
                                <td style="text-align:right;padding-right:1.25rem;">
                                    <span style="color:#94A3B8;font-size:0.78rem;font-weight:500;">{{ $activity->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;padding:2.5rem;color:#94A3B8;font-size:0.875rem;">
                                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                                    Belum ada aktivitas tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-header">
                <h6>Aktivitas Login Terakhir</h6>
            </div>
            <div class="card-body p-0">
                @forelse($loginLogs as $log)
                    <div style="padding:0.9rem 1.25rem;border-bottom:1px solid #F1F5F9;display:flex;align-items:center;gap:12px;">
                        <div style="width:36px;height:36px;border-radius:8px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-user" style="color:#2563EB;font-size:0.85rem;"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;color:#0F172A;font-size:0.85rem;">{{ $log->user->name ?? 'Unknown' }}</div>
                            <div style="color:#64748B;font-size:0.75rem;">{{ $log->ip_address }}</div>
                        </div>
                        <div style="text-align:right;flex-shrink:0;">
                            <div style="color:#94A3B8;font-size:0.75rem;font-weight:500;">{{ $log->login_at?->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:2.5rem;color:#94A3B8;font-size:0.875rem;">
                        <i class="fas fa-history d-block mb-2" style="font-size:2rem;"></i>
                        Belum ada data login.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Aktivitas',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    borderColor: '#2563EB',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, color: '#64748B', font: { size: 11 } },
                        grid: { color: '#F1F5F9', drawBorder: false }
                    },
                    x: {
                        ticks: { color: '#64748B', font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
