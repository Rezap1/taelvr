@extends('layouts.frontend')

@section('title', 'Program Studi - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Daftar program studi unggulan di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Program Studi" 
    :breadcrumbs="['Program Studi' => route('program-studi')]" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h2 class="fw-bold mb-3">Pilihan Program Akademik</h2>
            <p class="text-muted">Fakultas Teknik Universitas Suryakancana menawarkan program sarjana (S1) yang dirancang untuk menghasilkan lulusan yang kompeten, inovatif, dan siap menghadapi tantangan industri masa depan.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($programStudi as $index => $prodi)
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

@endsection
