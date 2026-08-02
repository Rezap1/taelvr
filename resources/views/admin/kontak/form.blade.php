<div class="row g-4">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Tipe Kontak <span class="text-danger">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="">Pilih Tipe...</option>
                    <option value="alamat" {{ old('type', $item->type ?? '') == 'alamat' ? 'selected' : '' }}>Alamat</option>
                    <option value="telepon" {{ old('type', $item->type ?? '') == 'telepon' ? 'selected' : '' }}>Telepon</option>
                    <option value="email" {{ old('type', $item->type ?? '') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="whatsapp" {{ old('type', $item->type ?? '') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    <option value="fax" {{ old('type', $item->type ?? '') == 'fax' ? 'selected' : '' }}>Fax</option>
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="label" class="form-label">Label (Nama Tampilan) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label', $item->label ?? '') }}" placeholder="Contoh: Kampus Utama / Email BAAK" required>
                @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai Kontak <span class="text-danger">*</span></label>
            <textarea class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" rows="4" placeholder="Contoh: Jl. Pasir Gede Raya, Cianjur atau 08123456789" required>{{ old('nilai', $item->nilai ?? '') }}</textarea>
            @error('nilai')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        
        <div class="mb-3">
            <label for="icon" class="form-label">Custom Icon Class (Opsional)</label>
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $item->icon ?? '') }}" placeholder="Contoh: fas fa-map-marker-alt">
            <div class="form-text">Gunakan class FontAwesome (misal: <code>fas fa-envelope</code>). Biarkan kosong untuk icon default.</div>
            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <label class="form-label">Status Tayang</label>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif (Tampil di Frontend)</label>
                </div>

                <label for="urutan" class="form-label">Urutan Tampil</label>
                <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" min="0">
            </div>
        </div>
    </div>
</div>
