@props(['message' => 'Data tidak ditemukan', 'icon' => 'fas fa-box-open'])

<div class="text-center py-5" data-aos="fade-up">
    <div class="mb-4">
        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 100px; height: 100px;">
            <i class="{{ $icon }} text-muted opacity-50" style="font-size: 3rem;"></i>
        </div>
    </div>
    <h5 class="fw-bold text-muted">{{ $message }}</h5>
    {{ $slot ?? '' }}
</div>
