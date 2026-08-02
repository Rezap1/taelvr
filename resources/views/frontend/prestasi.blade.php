@extends('layouts.frontend')

@section('title', 'Prestasi - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Berbagai prestasi gemilang mahasiswa Fakultas Teknik Universitas Suryakancana di kancah regional, nasional, dan internasional.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Prestasi Mahasiswa" 
    :breadcrumbs="['Prestasi' => route('prestasi')]" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;" data-aos="fade-up">
            <h2 class="fw-bold mb-3">Jejak Karya & Kebanggaan</h2>
            <p class="text-muted">Dedikasi dan kerja keras civitas akademika Fakultas Teknik Universitas Suryakancana terus menorehkan prestasi gemilang di berbagai ajang regional, nasional, hingga internasional.</p>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                @if($prestasi->count() > 0)
                <div class="timeline position-relative">
                    <!-- Timeline Line -->
                    <div class="position-absolute bg-primary" style="width: 2px; height: 100%; left: 50%; top: 0; transform: translateX(-50%); opacity: 0.2;"></div>

                    @foreach($prestasi as $index => $item)
                        @php
                            $alignment = ($index % 2 == 0) ? 'left' : 'right';
                        @endphp
                        <x-frontend.card-prestasi :item="[
                            'title' => $item->judul,
                            'date' => \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y'),
                            'level' => $item->tingkat,
                            'description' => $item->deskripsi . ($item->programStudi ? ' (Prodi: ' . $item->programStudi->nama . ')' : ''),
                            'image' => image_url($item->gambar)
                        ]" :alignment="$alignment" />
                    @endforeach
                </div>
                
                @if($prestasi->hasPages())
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    {{ $prestasi->links('pagination::bootstrap-5') }}
                </div>
                @endif
                
                @else
                    <x-frontend.empty-state message="Belum ada data prestasi yang ditambahkan." icon="fas fa-trophy" />
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @media (max-width: 767.98px) {
        .timeline > .position-absolute {
            left: 25px !important;
        }
        .timeline .col-md-2 {
            display: flex;
            justify-content: flex-start;
            padding-left: 0;
        }
    }
</style>
@endpush
