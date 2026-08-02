<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $item->nama ?? '') }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Lengkap</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <label class="form-label">Status & Urutan</label>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif (Tampil di Frontend)</label>
                </div>
                
                <label for="urutan" class="form-label">Urutan Tampil</label>
                <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" min="0">
            </div>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Fasilitas</label>
            @if(isset($item) && $item->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="Preview Gambar" class="img-thumbnail" style="max-height: 150px">
                </div>
            @endif
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*">
            <div class="form-text">Format: jpg, png, webp. Maks: 2MB.</div>
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Ikon Fasilitas (Opsional)</label>
            @if(isset($item) && $item->icon)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->icon) }}" alt="Preview Icon" class="img-thumbnail" style="max-height: 80px">
                </div>
            @endif
            <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" accept="image/*">
            <div class="form-text">Format: jpg, png, svg. Maks: 1MB.</div>
            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
