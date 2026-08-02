@props(['item'])

<a href="{{ $item['image'] ?? asset('assets/img/default-thumbnail.jpg') }}" data-fancybox="gallery" data-caption="{{ $item['title'] ?? '' }}" class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card text-decoration-none d-block">
    <img src="{{ $item['image'] ?? asset('assets/img/default-thumbnail.jpg') }}" alt="{{ $item['title'] ?? 'Galeri' }}" class="card-img-top object-fit-cover" style="height: 300px;" loading="lazy">
    
    @if(isset($item['type']) && $item['type'] === 'video')
    <div class="position-absolute top-50 start-50 translate-middle z-2">
        <i class="fas fa-play-circle text-white opacity-75" style="font-size: 4rem;"></i>
    </div>
    @endif
    
    <div class="gallery-overlay d-flex flex-column justify-content-end p-4 {{ isset($item['type']) && $item['type'] === 'video' ? 'z-1' : '' }}">
        @if(isset($item['category']))
            @php
                $badges = ['Akademik' => 'bg-primary', 'Kemahasiswaan' => 'bg-warning', 'Penelitian' => 'bg-success', 'Pengabdian' => 'bg-info'];
                $bgClass = $badges[$item['category']] ?? 'bg-secondary';
            @endphp
            <span class="badge {{ $bgClass }} mb-2 align-self-start">{{ $item['category'] }}</span>
        @endif
        <h5 class="text-white fw-bold mb-1">{{ $item['title'] ?? '' }}</h5>
        <small class="text-white-50"><i class="fas fa-calendar-alt me-1"></i> {{ $item['date'] ?? '' }}</small>
    </div>
</a>
