@props(['title', 'subtitle' => '', 'image' => null])

<section class="page-header bg-primary text-white py-5 position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ $image ?? asset('assets/img/patterns/cubes.png') }}'); {{ $image ? 'background-size: cover; background-position: center; opacity: 0.3;' : 'opacity: 0.1;' }}"></div>
    <div class="container py-5 position-relative z-1 text-center">
        <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">{{ $title }}</h1>
        @if($subtitle)
            <p class="lead text-white-50 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">{{ $subtitle }}</p>
        @endif
        {{ $slot ?? '' }}
    </div>
</section
