@extends('layouts.frontend')

@section('title', 'Kontak Kami - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Hubungi Fakultas Teknik Universitas Suryakancana untuk informasi pendaftaran, kerjasama, maupun pengaduan.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Hubungi Kami" 
    :breadcrumbs="['Kontak' => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Contact Info & Map --}}
            <div class="col-lg-5" data-aos="fade-right">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-4">
                    <h4 class="fw-bold text-primary mb-4">Informasi Kontak</h4>
                    
                    <div class="d-flex mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Alamat Kampus</h6>
                            <p class="text-muted small mb-0">{{ $settings['contact_address'] ?? 'Jl. Pasir Gede Raya, Bojongherang, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43216' }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Telepon & WhatsApp</h6>
                            <p class="text-muted small mb-0">{{ $settings['contact_phone'] ?? '(0263) 262793' }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Email Resmi</h6>
                            <p class="text-muted small mb-0">{{ $settings['contact_email'] ?? 'ft@unsur.ac.id' }}</p>
                        </div>
                    </div>
                    
                    <h6 class="fw-bold mt-4 mb-3">Sosial Media</h6>
                    <div class="d-flex gap-2">
                        @if(!empty($settings['social_facebook']))
                            <a href="{{ $settings['social_facebook'] }}" target="_blank" class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($settings['social_twitter']))
                            <a href="{{ $settings['social_twitter'] }}" target="_blank" class="btn btn-outline-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if(!empty($settings['social_instagram']))
                            <a href="{{ $settings['social_instagram'] }}" target="_blank" class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($settings['social_youtube']))
                            <a href="{{ $settings['social_youtube'] }}" target="_blank" class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 h-100">
                    <h4 class="fw-bold text-primary mb-2">Tinggalkan Pesan</h4>
                    <p class="text-muted small mb-4">Punya pertanyaan seputar Fakultas Teknik? Silakan isi form di bawah ini dan kami akan membalasnya melalui email.</p>
                    
                    <form action="#" method="POST" id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-light-subtle bg-white" id="name" name="name" required placeholder="Cth: Budi Santoso">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-bold">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control border-light-subtle bg-white" id="email" name="email" required placeholder="Cth: budi@gmail.com">
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label small fw-bold">Subjek Pesan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-light-subtle bg-white" id="subject" name="subject" required placeholder="Topik pertanyaan Anda">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label small fw-bold">Isi Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control border-light-subtle bg-white" id="message" name="message" rows="5" required placeholder="Tuliskan detail pertanyaan atau pesan Anda di sini..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="button" class="btn btn-primary fw-bold px-5 py-2 rounded-pill shadow-sm w-100 w-md-auto" onclick="alert('Pesan berhasil dikirim (Simulasi)')">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Full Width Map --}}
            <div class="col-12 mt-5" data-aos="fade-up">
                <div class="rounded-4 overflow-hidden shadow-sm border border-light" style="height: 400px;">
                    <!-- Google Maps Iframe -->
                    {!! $settings['contact_map'] ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5471946850257!2d107.13943361427509!3d-6.824765668652395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68525b6c9343df%3A0xc3318ddb3cb2fcd4!2sFakultas%20Teknik%20Universitas%20Suryakancana!5e0!3m2!1sid!2sid!4v1689580459341!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi FT UNSUR"></iframe>' !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
