@extends('layouts.frontend')

@section('title', 'Sedang Dalam Perbaikan - Fakultas Teknik Universitas Suryakancana')

@section('content')
<section class="py-5 bg-light d-flex align-items-center" style="min-height: 80vh;">
    <div class="container text-center py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6" data-aos="zoom-in">
                <div class="mb-5 position-relative mx-auto" style="max-width: 300px;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-warning bg-opacity-10 rounded-circle" style="z-index: 0; filter: blur(20px);"></div>
                    <i class="fas fa-tools text-warning position-relative z-1" style="font-size: 8rem;"></i>
                </div>
                
                <h1 class="display-1 fw-bold text-warning mb-0">503</h1>
                <h3 class="fw-bold text-dark mb-3">Sistem Sedang Dalam Perbaikan</h3>
                <p class="text-muted mb-5">Website Fakultas Teknik Universitas Suryakancana saat ini sedang dalam proses pemeliharaan rutin untuk meningkatkan kualitas layanan kami. Kami akan segera kembali online secepatnya.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" onclick="window.location.reload()" class="btn btn-warning rounded-pill px-5 fw-bold text-dark shadow-sm">
                        <i class="fas fa-sync-alt me-2"></i> Coba Lagi Nanti
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
