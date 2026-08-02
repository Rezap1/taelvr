@extends('layouts.frontend')

@section('title', 'Beranda - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Beranda Fakultas Teknik Universitas Suryakancana. Temukan informasi program studi, pendaftaran, dan fasilitas lengkap.')

@section('content')

{{-- 1. Hero Section (Dynamic Banners) --}}
@if($banners->count() > 0)
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <section class="hero-section position-relative bg-dark text-white overflow-hidden" style="min-height: 85vh;">
                        <img src="{{ image_url($banner->gambar) }}" alt="{{ $banner->judul }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="opacity: 0.4; z-index: 0;" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" onerror="this.src='{{ asset('assets/images/kampus_ft_unsur.png') }}'">
                        
                        <div class="container position-relative z-1 h-100 d-flex align-items-center" style="min-height: inherit;">
                            <div class="row w-100">
                                <div class="col-lg-8 py-5 my-5">
                                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-medium" data-aos="fade-up">Kampus Inovasi</span>
                                    <h1 class="display-3 fw-bold mb-4 text-white" data-aos="fade-up" data-aos-delay="100">{{ $banner->judul }}</h1>
                                    <p class="lead mb-5 text-white" style="max-width: 600px; opacity: 0.9;" data-aos="fade-up" data-aos-delay="200">{{ $banner->deskripsi }}</p>
                                    
                                    <div class="d-flex gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="300">
                                        @if($banner->url)
                                            <a href="{{ $banner->url }}" class="btn btn-primary btn-lg fw-semibold px-4 py-3 rounded-pill shadow">{{ $banner->teks_tombol ?? 'Selengkapnya' }} <i class="fas fa-arrow-right ms-2"></i></a>
                                        @else
                                            <a href="{{ route('pmb') }}" class="btn btn-primary btn-lg fw-semibold px-4 py-3 rounded-pill shadow">Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i></a>
                                            <a href="{{ route('program-studi') }}" class="btn btn-outline-light btn-lg fw-semibold px-4 py-3 rounded-pill">Jelajahi Program Studi</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endforeach
        </div>
        @if($banners->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
@else
    {{-- Fallback Hero --}}
    <section class="hero-section position-relative bg-dark text-white overflow-hidden" style="min-height: 85vh;">
        <img src="{{ image_url($settings['hero_image'] ?? null, 'assets/images/kampus_ft_unsur.png') }}" alt="Kampus FT UNSUR" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="opacity: 0.6; z-index: 0; mix-blend-mode: overlay;" loading="lazy">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(30, 64, 175, 0.4) 100%); z-index: 0;"></div>
        <div class="container position-relative z-1 h-100 d-flex align-items-center" style="min-height: inherit;">
            <div class="row w-100">
                <div class="col-lg-8 py-5 my-5">
                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fw-medium">Selamat Datang di Kampus Inovasi</span>
                    <h1 class="display-3 fw-bold mb-4 text-white">Fakultas Teknik<br><span class="text-warning">Universitas Suryakancana</span></h1>
                    <p class="lead mb-5 text-white" style="max-width: 600px; opacity: 0.9;">Mencetak Insinyur dan Lulusan Teknik yang adaptif, inovatif, dan berdaya saing global untuk membangun peradaban bangsa.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('pmb') }}" class="btn btn-primary btn-lg fw-semibold px-4 py-3 rounded-pill shadow">Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif



{{-- 2. Sambutan Dekan --}}
@if($profil)
<section id="section-profil" class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="position-relative">
                    <!-- Accent background element -->
                    <div class="rounded-4 position-absolute w-100 h-100" style="background: linear-gradient(135deg, #2563EB, #38BDF8); top: 15px; left: -15px; z-index: 0; opacity: 0.8;"></div>
                    <img src="{{ image_url($profil->foto_pimpinan ?? null, 'assets/img/default-avatar.jpg') }}" alt="Dekan FT UNSUR" class="img-fluid rounded-4 position-relative z-1 shadow-lg" style="object-fit: cover; object-position: top; height: 500px; width: 100%; border: 3px solid rgba(255,255,255,0.8);" loading="lazy">
                    
                    <!-- Glassmorphism Name Badge -->
                    <div class="position-absolute bottom-0 end-0 p-4 shadow-lg rounded-4 m-3 z-2 text-center" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.5);">
                        <h6 class="fw-bold mb-1" style="color: #1E3A8A;">{{ $profil->nama_pimpinan ?? 'Pimpinan Fakultas' }}</h6>
                        <small style="color: #3B82F6; font-weight: 500;">Dekan Fakultas Teknik</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="ps-lg-4">
                    <h6 class="fw-bold text-uppercase mb-2" style="color: #F59E0B; letter-spacing: 2px;">Sambutan Pimpinan</h6>
                    <h2 class="display-5 fw-bold mb-4" style="color: #1E3A8A;">Membangun Masa Depan Melalui <span class="text-primary">Pendidikan Teknik Berkelanjutan</span></h2>
                    <div class="fs-5 mb-4" style="line-height: 1.8; color: #475569;">
                        {!! $profil->sambutan_pimpinan ?? '<p>"Fakultas Teknik Universitas Suryakancana berkomitmen memberikan pengalaman belajar terbaik. Kami mengundang Anda bergabung dan menjadi bagian dari solusi teknologi masa depan."</p>' !!}
                    </div>
                    <a href="{{ route('profil') }}" class="btn btn-outline-primary fw-bold rounded-pill px-4 mt-3 hover-lift">Selengkapnya Tentang Kami <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- 3. Keunggulan / Why Choose Us --}}
<section id="section-keunggulan" class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Keunggulan Kami</h6>
            <h2 class="fw-bold mb-3">Mengapa Memilih FT UNSUR?</h2>
            <p class="text-muted">Beragam alasan yang menjadikan Fakultas Teknik Universitas Suryakancana sebagai tempat terbaik untuk mengembangkan potensi dan karir Anda.</p>
        </div>

        <div class="row g-4">
            <!-- Kurikulum -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm text-center p-4 hover-lift">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Kurikulum Industri</h5>
                    <p class="text-muted small mb-0">Kurikulum terintegrasi dengan kebutuhan dunia industri dan standar nasional pendidikan.</p>
                </div>
            </div>
            <!-- Fasilitas -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm text-center p-4 hover-lift">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-flask fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Fasilitas Lengkap</h5>
                    <p class="text-muted small mb-0">Laboratorium modern, perpustakaan memadai, dan ruang kelas yang nyaman didukung IT.</p>
                </div>
            </div>
            <!-- Dosen -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm text-center p-4 hover-lift">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Dosen Berpengalaman</h5>
                    <p class="text-muted small mb-0">Dibimbing oleh praktisi dan akademisi yang profesional di bidang keteknikan.</p>
                </div>
            </div>
            <!-- Lokasi -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow-sm text-center p-4 hover-lift">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Lokasi Strategis</h5>
                    <p class="text-muted small mb-0">Berada di pusat kota Cianjur dengan aksesibilitas yang sangat mudah dijangkau.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. Program Studi --}}
<section id="section-prodi" class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div style="max-width: 600px;">
                <h6 class="text-primary fw-bold text-uppercase mb-2">Program Akademik</h6>
                <h2 class="fw-bold mb-3">Program Studi Kami</h2>
                <p class="text-muted mb-0">Pilih program studi yang sesuai dengan minat dan cita-cita Anda untuk menghadapi tantangan masa depan.</p>
            </div>
            <a href="{{ route('program-studi') }}" class="btn btn-primary rounded-pill mt-3 mt-md-0 px-4">Lihat Semua Program <i class="fas fa-arrow-right ms-2"></i></a>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($program_studi as $index => $prodi)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <x-frontend.card-prodi :prodi="[
                        'name' => $prodi->nama,
                        'akreditasi' => $prodi->akreditasi,
                        'description' => $prodi->deskripsi,
                        'kaprodi' => $prodi->kaprodi,
                        'image' => image_url($prodi->gambar),
                        'url' => route('program-studi.show', $prodi->slug)
                    ]" />
                </div>
            @empty
                <div class="col-12">
                    <x-frontend.empty-state message="Belum ada program studi yang ditambahkan." icon="fas fa-graduation-cap" />
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- 5. Fasilitas Pilihan --}}
@if($fasilitas->count() > 0)
<section id="section-fasilitas" class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Fasilitas Kampus</h6>
            <h2 class="fw-bold mb-3">Fasilitas Pendukung Belajar</h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($fasilitas as $index => $item)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                        <img src="{{ image_url($item->gambar) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 200px; object-fit: cover;" loading="lazy">
                        <div class="card-body p-4 text-center">
                            <h6 class="fw-bold">{{ $item->nama }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('fasilitas') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua Fasilitas <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
@endif

{{-- 6. Prestasi Terbaru --}}
@if($prestasi->count() > 0)
<section id="section-prestasi" class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase mb-2">Hall of Fame</h6>
            <h2 class="fw-bold mb-3">Prestasi Mahasiswa</h2>
        </div>

        <div class="row g-4">
            @foreach($prestasi as $index => $item)
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="d-flex flex-column flex-sm-row gap-3 bg-white rounded-4 p-3 hover-lift border">
                        <img src="{{ image_url($item->gambar) }}" class="rounded-3 shadow-sm" alt="{{ $item->judul }}" style="width: 120px; height: 120px; object-fit: cover;" loading="lazy">
                        <div>
                            <span class="badge bg-primary mb-2">{{ $item->tingkat }}</span>
                            <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                            <p class="text-muted small mb-1"><i class="fas fa-user-graduate me-1"></i> {{ $item->nama_mahasiswa }}</p>
                            <p class="text-muted small mb-0"><i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('prestasi') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua Prestasi <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
@endif

{{-- 7. Alur Pendaftaran (PMB) --}}
<section id="section-pmb" class="py-5 bg-white position-relative overflow-hidden">
    <div class="container py-5 position-relative z-1">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h6 class="fw-bold text-uppercase mb-2" style="color: #F59E0B;">Penerimaan Mahasiswa Baru</h6>
            <h2 class="fw-bold mb-3" style="color: #1E3A8A;">Alur Pendaftaran Sederhana</h2>
            <p style="color: #475569;">Bergabunglah bersama kami. Proses pendaftaran sangat mudah dan dapat dilakukan secara online maupun offline.</p>
        </div>

        <div class="row position-relative">
            <!-- Connection Line (desktop only) -->
            <div class="d-none d-lg-block position-absolute bg-primary" style="height: 4px; top: 45px; left: 10%; right: 10%; z-index: 0; opacity: 0.2;"></div>
            
            <div class="col-md-6 col-lg-3 text-center mb-5 mb-lg-0 position-relative z-1" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 fs-3 shadow" style="width: 90px; height: 90px; border: 5px solid #fff;">
                    1
                </div>
                <h5 class="fw-bold" style="color: #1E3A8A;">Buat Akun</h5>
                <p class="small" style="color: #475569;">Buat akun pada portal resmi PMB UNSUR.</p>
            </div>
            
            <div class="col-md-6 col-lg-3 text-center mb-5 mb-lg-0 position-relative z-1" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 fs-3 shadow" style="width: 90px; height: 90px; border: 5px solid #fff;">
                    2
                </div>
                <h5 class="fw-bold" style="color: #1E3A8A;">Isi Formulir</h5>
                <p class="small" style="color: #475569;">Lengkapi biodata dan pilih program studi di Fakultas Teknik.</p>
            </div>
            
            <div class="col-md-6 col-lg-3 text-center mb-5 mb-md-0 position-relative z-1" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 fs-3 shadow" style="width: 90px; height: 90px; border: 5px solid #fff;">
                    3
                </div>
                <h5 class="fw-bold" style="color: #1E3A8A;">Ujian Masuk</h5>
                <p class="small" style="color: #475569;">Ikuti ujian saringan masuk sesuai jadwal yang ditentukan.</p>
            </div>
            
            <div class="col-md-6 col-lg-3 text-center position-relative z-1" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 fs-3 shadow" style="width: 90px; height: 90px; border: 5px solid #fff;">
                    4
                </div>
                <h5 class="fw-bold" style="color: #1E3A8A;">Daftar Ulang</h5>
                <p class="small" style="color: #475569;">Pengumuman kelulusan dan proses registrasi ulang (herregistrasi).</p>
            </div>
        </div>

        <div class="text-center mt-5 pt-3" data-aos="fade-up">
            <a href="{{ route('pmb') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Info Lengkap PMB</a>
            <a href="{{ route('daftar-pmb') }}" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold shadow hover-lift">Daftar Sekarang <i class="fas fa-external-link-alt ms-2"></i></a>
        </div>
    </div>
</section>

{{-- 8. CTA / Call to Action --}}
<x-frontend.cta-section 
    title="Siap Menjadi Insinyur Masa Depan?"
    description="Bergabunglah dengan ribuan mahasiswa lainnya untuk mengeksplorasi potensi diri Anda di bidang teknologi dan keteknikan."
    buttonText="Hubungi Kami"
    buttonUrl="{{ route('kontak') }}"
/>

@endsection


