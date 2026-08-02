<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="form-label">Judul (Title)</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $item->title ?? '') }}">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Sub Judul (Subtitle)</label>
            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $item->subtitle ?? '') }}">
            @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="button_text" class="form-label">Teks Tombol CTA</label>
                <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $item->button_text ?? '') }}" placeholder="Cth: Daftar Sekarang">
                @error('button_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8 mb-3">
                <label for="link" class="form-label">Link/URL Tujuan CTA</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $item->link ?? '') }}" placeholder="Cth: https://google.com atau /pmb">
                @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Penjadwalan Tayang (Opsional)</h6>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="start_date" class="form-label">Mulai Tayang</label>
                        <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', isset($item->start_date) ? $item->start_date->format('Y-m-d\TH:i') : '') }}">
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">Selesai Tayang</label>
                        <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', isset($item->end_date) ? $item->end_date->format('Y-m-d\TH:i') : '') }}">
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-text mt-2">Biarkan kosong jika banner tayang terus menerus (selama statusnya Aktif).</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-4">
            <x-admin.image-upload 
                name="file" 
                :existing="isset($item) ? $item->file_path : null" 
                label="Gambar Banner" 
                help="Format: JPG, PNG, WEBP (Rekomendasi 1920x800px)"
            />
        </div>

        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <label class="form-label">Status Tayang</label>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>

                <label for="urutan" class="form-label">Urutan Tampil (Slider)</label>
                <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" min="0">
            </div>
        </div>
    </div>
</div>
