@extends('layouts.frontend')

@section('title', 'Kesalahan Server - Fakultas Teknik Universitas Suryakancana')

@section('content')
<section class="py-5 bg-light d-flex align-items-center" style="min-height: 80vh;">
    <div class="container text-center py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6" data-aos="zoom-in">
                <div class="mb-5 position-relative mx-auto" style="max-width: 300px;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 bg-danger bg-opacity-10 rounded-circle" style="z-index: 0; filter: blur(20px);"></div>
                    <i class="fas fa-exclamation-triangle text-danger position-relative z-1" style="font-size: 8rem;"></i>
                </div>
                
                <h1 class="display-1 fw-bold text-danger mb-0">500</h1>
                <h3 class="fw-bold text-dark mb-3">Terjadi Kesalahan Server</h3>
                <p class="text-muted mb-5">Maaf, sistem kami sedang mengalami gangguan internal saat memproses permintaan Anda. Tim teknis kami sedang berupaya memperbaikinya. Silakan coba kembali beberapa saat lagi.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" onclick="window.location.reload()" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fas fa-sync-alt me-2"></i> Muat Ulang
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                        <i class="fas fa-home me-2"></i> Ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
