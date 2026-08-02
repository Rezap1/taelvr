@props(['item', 'alignment' => 'left'])

<div class="row align-items-center mb-5" data-aos="fade-up">
    @if($alignment === 'left')
        <div class="col-md-5 text-md-end order-2 order-md-1">
            <h5 class="fw-bold text-primary mb-1">{{ $item['title'] ?? '' }}</h5>
            <p class="text-muted small mb-2">
                <i class="fas fa-calendar-alt me-1"></i> {{ $item['date'] ?? '' }} | {{ $item['level'] ?? '' }}
            </p>
            <p class="small text-muted text-md-end text-start mb-0">{{ $item['description'] ?? '' }}</p>
        </div>
        <div class="col-md-2 text-center order-1 order-md-2 mb-3 mb-md-0 position-relative">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow position-relative z-1" style="width: 50px; height: 50px; border: 4px solid #f8f9fa;">
                <i class="fas fa-trophy"></i>
            </div>
        </div>
        <div class="col-md-5 order-3 order-md-3">
            <img src="{{ $item['image'] ?? asset('assets/img/default-thumbnail.jpg') }}" alt="{{ $item['title'] ?? 'Prestasi' }}" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" style="height: 200px;" loading="lazy">
        </div>
    @else
        <div class="col-md-5 order-2 order-md-1">
            <img src="{{ $item['image'] ?? asset('assets/img/default-thumbnail.jpg') }}" alt="{{ $item['title'] ?? 'Prestasi' }}" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" style="height: 200px;" loading="lazy">
        </div>
        <div class="col-md-2 text-center order-1 order-md-2 mb-3 mb-md-0 position-relative">
            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow position-relative z-1" style="width: 50px; height: 50px; border: 4px solid #f8f9fa;">
                <i class="fas fa-medal"></i>
            </div>
        </div>
        <div class="col-md-5 order-3 order-md-3 text-start">
            <h5 class="fw-bold text-primary mb-1">{{ $item['title'] ?? '' }}</h5>
            <p class="text-muted small mb-2">
                <i class="fas fa-calendar-alt me-1"></i> {{ $item['date'] ?? '' }} | {{ $item['level'] ?? '' }}
            </p>
            <p class="small text-muted mb-0">{{ $item['description'] ?? '' }}</p>
        </div>
    @endif
</div>
