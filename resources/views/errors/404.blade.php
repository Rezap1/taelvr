@php
    $isAdmin = request()->is('admin/*') || request()->is('admin');
@endphp

@extends($isAdmin ? 'layouts.admin' : 'layouts.frontend')

@section('title', 'Halaman Tidak Ditemukan - Fakultas Teknik Universitas Suryakancana')

@section('content')
<section class="py-5 d-flex align-items-center" style="min-height: 80vh; {{ $isAdmin ? 'background: var(--bg-page);' : 'background: #f8f9fa;' }}">
    <div class="container text-center py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6" data-aos="zoom-in">
                <!-- SVG Illustration -->
                <div class="mb-5 position-relative mx-auto" style="max-width: 300px;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-primary bg-opacity-10 rounded-circle" style="z-index: 0; filter: blur(20px);"></div>
                    <i class="fas fa-search-location text-primary position-relative z-1" style="font-size: 8rem;"></i>
                </div>
                
                <h1 class="display-1 fw-bold text-primary mb-0">404</h1>
                <h3 class="fw-bold text-dark mb-3">Halaman Tidak Ditemukan</h3>
                <p class="text-muted mb-5">Maaf, halaman yang Anda cari mungkin telah dihapus, diubah namanya, atau sementara tidak tersedia. Silakan periksa kembali URL Anda atau kembali ke halaman utama.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" onclick="history.back()" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                    <a href="{{ $isAdmin ? route('admin.dashboard') : route('home') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                        <i class="fas {{ $isAdmin ? 'fa-tachometer-alt' : 'fa-home' }} me-2"></i> {{ $isAdmin ? 'Ke Dashboard' : 'Ke Beranda' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
