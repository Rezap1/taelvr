@props(['title', 'description', 'buttonText', 'buttonUrl'])

<section class="py-5 position-relative overflow-hidden bg-white text-center">
    <div class="container py-5 position-relative z-1">
        <h2 class="display-5 fw-bold mb-4" style="color: #1E3A8A;" data-aos="zoom-in">{{ $title }}</h2>
        @if($description)
            <p class="lead mb-5 mx-auto" style="max-width: 600px; color: #475569;" data-aos="zoom-in" data-aos-delay="100">{{ $description }}</p>
        @endif
        <div data-aos="zoom-in" data-aos-delay="200">
            <a href="{{ $buttonUrl }}" class="btn btn-primary btn-lg fw-bold rounded-pill px-5 py-3 shadow hover-lift">{{ $buttonText }} <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

@push('styles')
<style>
    @keyframes spin-slow { 100% { transform: rotate(360deg); } }
    @keyframes spin-slow-reverse { 100% { transform: rotate(-360deg); } }
</style>
@endpush
