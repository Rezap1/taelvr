@extends('layouts.frontend')

@section('title', 'Galeri - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Galeri dokumentasi kegiatan akademik, kemahasiswaan, dan pengabdian masyarakat di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Galeri Kegiatan" 
    :breadcrumbs="['Galeri' => route('galeri')]" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Filter Kategori -->
        @if($kategoriGaleri && $kategoriGaleri->count() > 0)
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="btn {{ !request('kategori') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">Semua</a>
            @foreach($kategoriGaleri as $kategori)
                <a href="{{ route('galeri', ['kategori' => $kategori->id]) }}" class="btn {{ request('kategori') == $kategori->id ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">{{ $kategori->nama }}</a>
            @endforeach
        </div>
        @endif

        <div class="row g-4">
            @forelse($galeri as $index => $item)
                <div class="col-sm-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <x-frontend.card-galeri :item="[
                        'title' => $item->judul,
                        'category' => $item->kategoriGaleri->nama ?? 'Umum',
                        'date' => \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y'),
                        'type' => $item->file_type === 'video' || $item->file_type === 'mp4' ? 'video' : 'image',
                        'image' => image_url($item->file_path)
                    ]" />
                </div>
            @empty
                <div class="col-12">
                    <x-frontend.empty-state message="Belum ada dokumentasi galeri." icon="fas fa-images" />
                </div>
            @endforelse
        </div>

        @if($galeri->hasPages())
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            {{ $galeri->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    .gallery-card {
        position: relative;
        cursor: pointer;
    }
    .gallery-card img {
        transition: transform 0.5s ease;
    }
    .gallery-card:hover img {
        transform: scale(1.05);
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Fancybox.bind('[data-fancybox="gallery"]', {
            loop: true,
            buttons: [
                "slideShow",
                "fullScreen",
                "thumbs",
                "close"
            ],
            animationEffect: "fade"
        });
    });
</script>
@endpush
