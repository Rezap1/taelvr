@extends('layouts.frontend')

@section('title', 'S1 ' . $prodi->nama . ' - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Informasi lengkap mengenai S1 ' . $prodi->nama . ' di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="S1 {{ $prodi->nama }}" 
    :breadcrumbs="['Program Studi' => route('program-studi'), 'S1 ' . $prodi->nama => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <!-- Cover Image -->
                <div class="mb-4 rounded-4 overflow-hidden shadow-sm" data-aos="fade-up">
                    <img src="{{ image_url($prodi->gambar) }}" alt="Cover {{ $prodi->nama }}" class="img-fluid w-100 object-fit-cover" style="max-height: 400px;" loading="lazy">
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Deskripsi Program Studi</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! $prodi->deskripsi ?? '<p>Belum ada deskripsi untuk program studi ini.</p>' !!}
                    </div>
                </div>

                <!-- Prospek Karir -->
                @if(!empty($prodi->prospek_karir))
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Prospek Karier</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! $prodi->prospek_karir !!}
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <!-- Info Prodi -->
                <div class="bg-white rounded-4 shadow-sm p-4 mb-4" data-aos="fade-left">
                    <h5 class="fw-bold text-primary mb-4">Informasi Program Studi</h5>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-barcode me-2 text-primary"></i> Kode Prodi</span>
                            <span class="fw-bold">{{ $prodi->kode ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-user-tie me-2 text-primary"></i> Ketua Prodi</span>
                            <span class="fw-bold">{{ $prodi->kaprodi ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-award me-2 text-primary"></i> Akreditasi</span>
                            <span class="badge bg-success rounded-pill px-3">{{ $prodi->akreditasi ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-graduation-cap me-2 text-primary"></i> Jenjang</span>
                            <span class="fw-bold">{{ $prodi->jenjang ?? 'S1' }}</span>
                        </li>
                    </ul>

                    @if(!empty($prodi->icon))
                    <div class="text-center p-3 bg-white rounded-3 border">
                        <img src="{{ image_url($prodi->icon) }}" alt="Icon Prodi" width="60" height="60" loading="lazy">
                    </div>
                    @endif
                </div>
                
                <!-- CTA -->
                <div class="bg-primary text-white rounded-4 shadow p-4 text-center" data-aos="fade-left" data-aos-delay="100">
                    <h5 class="fw-bold mb-3">Tertarik Bergabung?</h5>
                    <p class="small text-white-50 mb-4">Jadilah bagian dari Program Studi S1 {{ $prodi->nama }} dan raih masa depan cemerlang Anda.</p>
                    <a href="{{ route('pmb') }}" class="btn btn-light text-primary fw-bold rounded-pill w-100 py-2">Informasi Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
