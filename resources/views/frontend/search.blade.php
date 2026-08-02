@extends('layouts.frontend')

@section('title', 'Hasil Pencarian - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Halaman pencarian informasi di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Hasil Pencarian" 
    :breadcrumbs="['Pencarian' => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white" style="min-height: 60vh;">
    <div class="container py-4">
        
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <form action="{{ route('frontend.search') }}" method="GET" class="d-flex bg-white rounded-pill p-2 shadow-sm">
                    <input type="text" name="q" value="{{ request('q', $keyword ?? '') }}" class="form-control border-0 bg-transparent px-4 py-2" placeholder="Cari informasi program studi, berita, fasilitas, atau pmb..." required>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Cari</button>
                </form>
                
                @if(request('q') || !empty($keyword))
                <p class="text-muted text-center mt-3 small">Menampilkan hasil pencarian untuk: <strong>"{{ request('q', $keyword ?? '') }}"</strong></p>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if(request('q') || !empty($keyword))
                    @if($results->count() > 0)
                        <div class="list-group list-group-flush shadow-sm rounded-4" data-aos="fade-up">
                            @foreach($results as $item)
                                <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action p-4 border-0 border-bottom">
                                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2">{{ $item['type'] }}</span>
                                    <h5 class="fw-bold mb-1">{{ $item['title'] }}</h5>
                                    <p class="text-muted small mb-0">{{ Str::limit(strip_tags($item['description']), 150) }}</p>
                                </a>
                            @endforeach
                        </div>
                        
                        @if($results->hasPages())
                        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                            {{ $results->appends(['q' => $keyword])->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    @else
                        <x-frontend.empty-state message="Tidak ditemukan hasil yang cocok dengan kata kunci '{{ $keyword }}'." icon="fas fa-search-minus" />
                    @endif
                @else
                    <x-frontend.empty-state message="Silakan masukkan kata kunci pencarian pada kotak di atas." icon="fas fa-search" />
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
