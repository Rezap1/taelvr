@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('breadcrumb')
    <h4 class="mb-0">Settings</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Website</li>
        </ol>
    </nav>
@endsection

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush rounded" id="settings-nav" role="tablist">
                        @php $first = true; @endphp
                        @forelse($settings as $group => $items)
                            <a class="list-group-item list-group-item-action {{ $first ? 'active' : '' }}" 
                               id="list-{{ Str::slug($group) }}-list" 
                               data-bs-toggle="list" 
                               href="#list-{{ Str::slug($group) }}" 
                               role="tab" 
                               aria-controls="{{ Str::slug($group) }}">
                                <i class="fas fa-{{ $group == 'general' ? 'globe' : ($group == 'seo' ? 'search' : ($group == 'social' ? 'share-alt' : 'cog')) }} me-2"></i>
                                {{ ucfirst($group) }}
                            </a>
                            @php $first = false; @endphp
                        @empty
                            <div class="p-3 text-muted">Belum ada pengaturan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="mt-4 d-grid">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i> Simpan Pengaturan</button>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card card-modern border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="tab-content" id="nav-tabContent">
                        @php $first = true; @endphp
                        @forelse($settings as $group => $items)
                            <div class="tab-pane fade {{ $first ? 'show active' : '' }}" id="list-{{ Str::slug($group) }}" role="tabpanel" aria-labelledby="list-{{ Str::slug($group) }}-list">
                                <h5 class="fw-bold border-bottom pb-3 mb-4 text-primary">{{ ucfirst($group) }} Settings</h5>
                                
                                @foreach($items as $setting)
                                    <div class="mb-4">
                                        <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                            {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                        </label>
                                        
                                        @if($setting->type == 'text')
                                            <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                                        @elseif($setting->type == 'textarea')
                                            <textarea class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" rows="4">{{ old($setting->key, $setting->value) }}</textarea>
                                        @elseif($setting->type == 'image')
                                            <div class="d-flex align-items-start gap-3">
                                                @if($setting->value)
                                                    <img src="{{ asset('storage/'.$setting->value) }}" alt="Preview" class="img-thumbnail" style="max-height: 100px; max-width: 200px;">
                                                @else
                                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width: 100px; height: 100px;">
                                                        <i class="fas fa-image fa-2x"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <input type="file" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" accept="image/*">
                                                    <div class="form-text mt-2 text-muted">Upload file baru untuk mengganti gambar saat ini. (Format: jpg, png, webp, Maks: 2MB)</div>
                                                </div>
                                            </div>
                                        @elseif($setting->type == 'boolean')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $setting->key }}" name="{{ $setting->key }}" value="1" {{ old($setting->key, $setting->value) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $setting->key }}">Aktifkan</label>
                                            </div>
                                        @elseif($setting->type == 'html')
                                            <textarea class="form-control tinymce-editor" id="{{ $setting->key }}" name="{{ $setting->key }}" rows="6">{{ old($setting->key, $setting->value) }}</textarea>
                                        @endif
                                        
                                        @if($setting->description)
                                            <div class="form-text text-muted mt-1"><i class="fas fa-info-circle me-1"></i>{{ $setting->description }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @php $first = false; @endphp
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted mb-0">Tabel settings kosong. Jalankan seeder untuk mengisi data awal.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
