@props(['title', 'breadcrumbs' => []])

<section class="page-header bg-white py-5 position-relative overflow-hidden border-bottom">
    <div class="container py-4 position-relative z-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none hover-primary"><i class="fas fa-home me-1"></i> Beranda</a></li>
                @foreach($breadcrumbs as $label => $url)
                    @if($loop->last)
                        <li class="breadcrumb-item active fw-bold" style="color: #1E3A8A;" aria-current="page">{{ $label }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $url }}" class="text-muted text-decoration-none hover-primary">{{ $label }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
        <h1 class="display-4 fw-bold mb-0" data-aos="fade-up" style="color: #1E3A8A;">{{ $title }}</h1>
    </div>
</section>
