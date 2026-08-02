@props(['item'])

<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
    <img src="{{ $item['image'] ?? asset('assets/img/default-thumbnail.jpg') }}" class="card-img-top object-fit-cover" alt="{{ $item['name'] ?? 'Fasilitas' }}" style="height: 250px;" loading="lazy">
    <div class="card-body p-4">
        <h5 class="fw-bold text-primary mb-2">{{ $item['name'] ?? '' }}</h5>
        <p class="text-muted small mb-0">{{ $item['description'] ?? '' }}</p>
    </div>
</div>
