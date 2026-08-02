@props(['active' => true])

@if($active)
    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Aktif</span>
@else
    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Tidak Aktif</span>
@endif
