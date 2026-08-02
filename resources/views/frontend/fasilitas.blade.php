@extends('layouts.frontend')

@section('title', 'Fasilitas - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Fasilitas pendukung akademik dan kemahasiswaan di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Fasilitas Kampus" 
    :breadcrumbs="['Fasilitas' => route('fasilitas')]" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h2 class="fw-bold mb-3">Lingkungan Belajar yang Mendukung</h2>
            <p class="text-muted">Fakultas Teknik Universitas Suryakancana menyediakan berbagai fasilitas akademik dan non-akademik modern untuk mendukung proses perkuliahan dan pengembangan potensi mahasiswa.</p>
        </div>

        <div class="row g-4">
            @forelse($fasilitas as $index => $item)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <x-frontend.card-fasilitas :item="[
                        'name' => $item->nama,
                        'description' => $item->deskripsi,
                        'image' => image_url($item->gambar)
                    ]" />
                </div>
            @empty
                <div class="col-12">
                    <x-frontend.empty-state message="Belum ada data fasilitas yang ditambahkan." icon="fas fa-building" />
                </div>
            @endforelse
        </div>

        @if($fasilitas->hasPages())
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            {{ $fasilitas->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</section>
@endsection
