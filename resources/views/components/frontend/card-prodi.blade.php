@props(['prodi'])

<div class="card h-100 border-0 shadow rounded-4 overflow-hidden card-hover">
    <div class="position-relative">
        <img src="{{ $prodi['image'] ?? asset('assets/images/kampus_ft_unsur.png') }}" class="card-img-top object-fit-cover" alt="{{ $prodi['name'] }}" style="height: 200px;" loading="lazy">
        @if(isset($prodi['akreditasi']))
        <div class="position-absolute top-0 end-0 m-3">
            <span class="badge bg-primary text-white fw-bold shadow-sm">Akreditasi {{ $prodi['akreditasi'] }}</span>
        </div>
        @endif
    </div>
    <div class="card-body p-4">
        <h4 class="fw-bold mb-3">{{ $prodi['name'] }}</h4>
        <p class="text-muted small mb-4">{{ Str::limit($prodi['description'] ?? '', 100) }}</p>
        
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-user-tie text-primary me-3 fs-5"></i>
            <div>
                <small class="text-muted d-block" style="font-size: 0.7rem;">Ketua Program Studi</small>
                <span class="fw-bold small">{{ $prodi['kaprodi'] ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white border-0 p-4 pt-0">
        <a href="{{ $prodi['url'] ?? '#' }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold">Detail Program <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</div>
