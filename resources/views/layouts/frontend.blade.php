<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Optimization --}}
    <title>@yield('title', $settings['site_name'] ?? 'Fakultas Teknik Universitas Suryakancana')</title>
    <meta name="description" content="@yield('meta_description', $settings['seo_description'] ?? 'Fakultas Teknik Universitas Suryakancana (FT UNSUR)')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['seo_keywords'] ?? 'Fakultas Teknik, Universitas Suryakancana')">
    <meta name="author" content="{{ $settings['site_name'] ?? 'Fakultas Teknik Universitas Suryakancana' }}">
    
    {{-- Canonical Tag --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $settings['site_name'] ?? 'Fakultas Teknik Universitas Suryakancana')">
    <meta property="og:description" content="@yield('meta_description', $settings['seo_description'] ?? 'Fakultas Teknik Universitas Suryakancana')">
    <meta property="og:image" content="@yield('meta_image', image_url($settings['hero_image'] ?? null, 'assets/img/default-banner.jpg'))">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', $settings['site_name'] ?? 'Fakultas Teknik Universitas Suryakancana')">
    <meta name="twitter:description" content="@yield('meta_description', $settings['seo_description'] ?? 'Fakultas Teknik Universitas Suryakancana')">
    <meta name="twitter:image" content="@yield('meta_image', image_url($settings['hero_image'] ?? null, 'assets/img/default-banner.jpg'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ image_url($settings['favicon'] ?? null, 'assets/img/default-logo.png') }}">

    {{-- Structured Data Schema.org --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "CollegeOrUniversity",
      "name": "{{ $settings['site_name'] ?? 'Fakultas Teknik Universitas Suryakancana' }}",
      "url": "{{ url('/') }}",
      "logo": "{{ image_url($settings['logo'] ?? null) }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "{{ $settings['phone'] ?? '' }}",
        "contactType": "customer service"
      }
    }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Frontend CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/elvira.css') }}">
    <style>
        :root {
            --bs-primary: #0d6efd; /* Blue UNSUR */
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary: #6c757d;
            --bs-font-sans-serif: 'Inter', sans-serif;
            --bs-font-heading: 'Outfit', sans-serif;
        }
        
        body {
            font-family: var(--bs-font-sans-serif);
            color: #4a5568;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: var(--bs-font-heading);
            color: #1E3A8A;
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(90deg, #0F172A 0%, #1E40AF 70%, #2563EB 100%) !important;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .navbar-brand img {
            height: 40px;
        }
        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s;
            border-radius: 8px;
        }
        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
        }
        
        .navbar-brand .text-primary { color: #ffffff !important; }
        .navbar-brand .text-secondary { color: rgba(255, 255, 255, 0.7) !important; }

        /* Footer Styling */
        .footer {
            background: linear-gradient(90deg, #0F172A 0%, #1E40AF 70%, #2563EB 100%);
            color: #cbd5e0;
            overflow: hidden;
            position: relative;
        }
        .footer-heading {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        .footer-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--bs-primary);
        }
        .footer-link {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-block;
            margin-bottom: 0.5rem;
        }
        .footer-link:hover {
            color: #fff;
            text-decoration: none;
            transform: translateX(5px);
        }

        /* Utilities */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .hover-primary {
            transition: color 0.2s ease;
        }
        .hover-primary:hover {
            color: var(--bs-primary) !important;
        }

        /* Animations */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0) translateX(-50%);}
            40% {transform: translateY(-20px) translateX(-50%);}
            60% {transform: translateY(-10px) translateX(-50%);}
        }
        @keyframes float-up-down {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes float-left-right {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            50% { transform: translateX(20px) rotate(-5deg); }
        }
        @keyframes spin-slow-reverse { 100% { transform: rotate(-360deg); } }

        /* Responsive Mobile Optimizations */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(15, 23, 42, 0.95);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 12px;
                padding: 1rem;
                margin-top: 1rem;
                box-shadow: 0 15px 35px rgba(0,0,0,0.2);
                border: 1px solid rgba(255,255,255,0.1);
            }
            .nav-item {
                margin-bottom: 0.3rem;
            }
            .nav-link {
                padding: 0.75rem 1rem !important;
                border-radius: 8px;
            }
            .dropdown-menu {
                background: transparent;
                border: none;
                padding-left: 1rem;
            }
            .dropdown-item {
                color: rgba(255,255,255,0.8);
                padding: 0.5rem 1rem;
            }
            .dropdown-item:hover {
                background: rgba(255,255,255,0.1);
                color: #fff;
                border-radius: 6px;
            }
            .navbar-brand img {
                width: 45px !important;
                height: 45px !important;
            }
            .navbar-brand .fs-5 {
                font-size: 1.1rem !important;
            }
            .navbar-brand .fs-6 {
                font-size: 0.8rem !important;
            }
            .display-3 {
                font-size: 2.5rem;
            }
            .hero-section {
                min-height: 100vh !important;
                padding-top: 80px;
            }
            .hero-section .py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            .hero-section .my-5 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .footer {
                text-align: center;
            }
            .footer-heading::after {
                left: 50%;
                transform: translateX(-50%);
            }
            .navbar-toggler {
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 8px !important;
                padding: 0.5rem 0.75rem;
            }
            .navbar-toggler:focus {
                box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.2) !important;
            }
            .navbar-toggler-icon {
                filter: brightness(0) invert(1);
            }
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Topbar (Removed) --}}

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3 position-relative">
        <!-- Navbar Animations Container -->
        <div class="position-absolute w-100 h-100 top-0 start-0 z-0 overflow-hidden" style="pointer-events: none;">
            <div class="position-absolute" style="top: 15px; left: 25%; color: #ffffff; opacity: 0.15; animation: float-up-down 6s ease-in-out infinite;">
                <i class="fas fa-microchip" style="font-size: 2.5rem;"></i>
            </div>
            <div class="position-absolute" style="bottom: 10px; right: 30%; color: #ffffff; opacity: 0.15; animation: float-left-right 8s ease-in-out infinite;">
                <i class="fas fa-laptop-code" style="font-size: 3rem;"></i>
            </div>
        </div>

        <div class="container position-relative z-1">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ image_url($settings['logo'] ?? null, 'images/logo-unsur.png') }}" alt="Logo FT UNSUR" class="me-3" style="width: 65px; height: 65px; object-fit: contain;" onerror="this.src='https://ui-avatars.com/api/?name=FT&background=0D8ABC&color=fff'">
                <div>
                    <span class="d-block fw-bold fs-5 lh-1 text-primary">{{ $settings['site_name'] ?? 'Fakultas Teknik' }}</span>
                    <span class="d-block fw-normal fs-6 lh-1 mt-1 text-secondary" style="font-family: var(--bs-font-sans-serif);">Universitas Suryakancana</span>
                </div>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    {{-- Navigation links removed. Elvira is the sole navigation guide. --}}
                    @if(!request()->routeIs('home'))
            <div class="ms-auto d-flex align-items-center">
                <a href="{{ route('home') }}" class="btn btn-outline-light rounded-pill px-3 px-md-4 fw-bold btn-sm-mobile">
                    <i class="fas fa-arrow-left me-1 me-md-2"></i> <span class="d-none d-sm-inline">Kembali ke Beranda</span>
                </a>
            </div>
            @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer pt-5 pb-3">
        <!-- Footer Animations -->
        <div class="position-absolute z-0" style="top: 10%; right: 10%; color: #ffffff; opacity: 0.04; animation: spin-slow 25s linear infinite;">
            <i class="fas fa-cog" style="font-size: 16rem;"></i>
        </div>
        <div class="position-absolute z-0" style="bottom: 10%; left: 5%; color: #ffffff; opacity: 0.03; animation: float-up-down 10s ease-in-out infinite;">
            <i class="fas fa-hard-hat" style="font-size: 18rem;"></i>
        </div>
        <div class="position-absolute z-0" style="top: 30%; left: 40%; color: #ffffff; opacity: 0.03; animation: float-left-right 15s ease-in-out infinite reverse;">
            <i class="fas fa-drafting-compass" style="font-size: 14rem;"></i>
        </div>
        
        <div class="container position-relative z-1">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ image_url($settings['logo'] ?? null, 'images/logo-unsur.png') }}" alt="Logo" class="me-3" style="height: 70px; object-fit: contain;" onerror="this.style.display='none'">
                        <h4 class="mb-0 text-white font-heading fw-bold">{{ $settings['site_name'] ?? 'Fakultas Teknik' }}</h4>
                    </div>
                    <p class="small text-white-50 mb-4" style="line-height: 1.8;">{{ $settings['footer_text'] ?? 'Universitas Suryakancana (UNSUR) adalah perguruan tinggi swasta terkemuka di Cianjur yang berkomitmen menyelenggarakan pendidikan teknik berkualitas tinggi.' }}</p>
                    <div class="d-flex gap-2">
                        @if(!empty($settings['facebook'])) <a href="{{ $settings['facebook'] }}" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fab fa-facebook-f"></i></a> @endif
                        @if(!empty($settings['twitter'])) <a href="{{ $settings['twitter'] }}" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fab fa-twitter"></i></a> @endif
                        @if(!empty($settings['instagram'])) <a href="{{ $settings['instagram'] }}" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fab fa-instagram"></i></a> @endif
                        @if(!empty($settings['youtube'])) <a href="{{ $settings['youtube'] }}" target="_blank" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fab fa-youtube"></i></a> @endif
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-heading">Akademik</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('program-studi') }}" class="footer-link">Program Studi</a></li>
                        <li><a href="{{ route('prestasi') }}" class="footer-link">Prestasi Mahasiswa</a></li>
                        <li><a href="{{ route('galeri') }}" class="footer-link">Galeri Kegiatan</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-heading">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('profil') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('fasilitas') }}" class="footer-link">Fasilitas Kampus</a></li>
                        <li><a href="{{ route('pmb') }}" class="footer-link">Info PMB</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <h5 class="footer-heading">Kontak</h5>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-3 d-flex">
                            <i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i>
                            <span>{{ $settings['address'] ?? 'Jl. Pasir Gede Raya, Bojongherang, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43216' }}</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone-alt me-3 text-primary"></i>
                            <span>{{ $settings['phone'] ?? '(0263) 262793' }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-envelope me-3 text-primary"></i>
                            <span>{{ $settings['email'] ?? 'ft@unsur.ac.id' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-secondary opacity-25">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-white-50 mb-0">&copy; {{ date('Y') }} Fakultas Teknik Universitas Suryakancana. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-white-50 small text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white-50 small text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS Animation
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
    @stack('scripts')
    
    <!-- Elvira Virtual Assistant Component & Scripts -->
    <x-frontend.elvira />
    <script src="{{ asset('assets/frontend/js/elvira.js') }}"></script>
</body>
</html>
