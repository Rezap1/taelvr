@extends('layouts.frontend')

@section('title', 'Profil - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Sejarah, Visi, Misi, dan profil pimpinan Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Profil Fakultas" 
    :breadcrumbs="['Profil Fakultas' => route('profil')]" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        @if(!empty($profil->gambar))
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up">
                <div class="rounded-4 overflow-hidden shadow-sm" style="height: 350px;">
                    <img src="{{ image_url($profil->gambar) }}" alt="Gedung Fakultas" class="w-100 h-100 object-fit-cover" loading="lazy">
                </div>
            </div>
        </div>
        @endif

        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <!-- Sejarah -->
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Sejarah Singkat</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! $profil->sejarah ?? '<p>Belum ada data sejarah.</p>' !!}
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Visi & Misi</h3>
                    
                    <h5 class="fw-bold mb-3"><i class="fas fa-eye text-primary me-2"></i> Visi</h5>
                    <div class="text-muted mb-4 fst-italic" style="line-height: 1.8;">
                        {!! $profil->visi ?? '<p>Belum ada data visi.</p>' !!}
                    </div>

                    <h5 class="fw-bold mb-3"><i class="fas fa-bullseye text-primary me-2"></i> Misi</h5>
                    <div class="text-muted mb-4" style="line-height: 1.8;">
                        {!! $profil->misi ?? '<p>Belum ada data misi.</p>' !!}
                    </div>
                    
                    @if(!empty($profil->tujuan))
                        <h5 class="fw-bold mb-3 mt-4"><i class="fas fa-crosshairs text-primary me-2"></i> Tujuan</h5>
                        <div class="text-muted mb-0" style="line-height: 1.8;">
                            {!! $profil->tujuan !!}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <!-- Pimpinan Fakultas -->
                <div class="bg-white rounded-4 shadow-sm p-4 mb-4 sticky-top" style="top: 100px;" data-aos="fade-left">
                    <h4 class="fw-bold text-primary mb-4">Pimpinan Fakultas</h4>
                    
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                        <img src="{{ image_url($profil->foto_pimpinan ?? null, 'assets/img/default-avatar.jpg') }}" alt="Dekan" class="rounded-circle object-fit-cover shadow-sm" width="70" height="70" loading="lazy">
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">{{ $profil->nama_pimpinan ?? 'Nama Dekan' }}</h6>
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Dekan</small>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-sitemap text-primary me-2"></i> Struktur Organisasi</h6>
                        @if(!empty($profil->struktur_organisasi))
                            <a href="{{ image_url($profil->struktur_organisasi) }}" target="_blank" class="btn btn-outline-primary w-100 rounded-pill">
                                <i class="fas fa-search-plus me-2"></i> Lihat Struktur
                            </a>
                        @else
                            <p class="text-muted small mb-0">Struktur organisasi belum diunggah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
