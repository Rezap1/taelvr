@extends('layouts.frontend')

@section('title', 'Informasi PMB - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Informasi lengkap pendaftaran mahasiswa baru (PMB) Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Informasi PMB" 
    :breadcrumbs="['Penerimaan Mahasiswa Baru' => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <!-- Info Pendaftaran -->
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">{{ $informasi->judul ?? 'Informasi Penerimaan Mahasiswa Baru' }}</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! $informasi->deskripsi ?? '<p>Belum ada informasi pendaftaran yang ditambahkan.</p>' !!}
                    </div>

                    @if(!empty($informasi->persyaratan))
                        <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fas fa-list-check text-primary me-2"></i> Persyaratan Pendaftaran</h4>
                        <div class="text-muted" style="line-height: 1.8;">
                            {!! $informasi->persyaratan !!}
                        </div>
                    @endif

                    @if(!empty($informasi->alur_pendaftaran))
                        <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fas fa-route text-primary me-2"></i> Alur Pendaftaran</h4>
                        <div class="text-muted" style="line-height: 1.8;">
                            {!! $informasi->alur_pendaftaran !!}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <!-- Navigasi PMB -->
                <div class="bg-white rounded-4 shadow-sm p-4 mb-4" data-aos="fade-left">
                    <h5 class="fw-bold text-primary mb-4">Menu PMB</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('pmb') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center fw-bold text-primary bg-white rounded-3 mb-2 border-0">
                            Informasi PMB <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('jadwal-pmb') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 mb-2 rounded-3 text-muted">
                            Jadwal Pendaftaran <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('biaya') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 mb-2 rounded-3 text-muted">
                            Biaya Pendidikan <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('program-studi') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-3 text-muted">
                            Daftar Program Studi <i class="fas fa-chevron-right small"></i>
                        </a>
                    </div>
                </div>

                <!-- CTA Pendaftaran -->
                <div class="bg-primary text-white rounded-4 shadow p-4 text-center" data-aos="fade-left" data-aos-delay="100">
                    <h5 class="fw-bold mb-3">Siap Mendaftar?</h5>
                    <p class="small text-white-50 mb-4">Pendaftaran dapat dilakukan secara online melalui portal resmi PMB UNSUR.</p>
                    <a href="{{ route('daftar-pmb') }}" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill w-100 py-2 shadow-sm">Portal PMB Online <i class="fas fa-external-link-alt ms-2"></i></a>
                    
                    <div class="mt-4 pt-3 border-top border-light border-opacity-25">
                        <p class="small text-white-50 mb-1">Butuh Bantuan?</p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-white text-decoration-none fw-bold">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp Panitia
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
