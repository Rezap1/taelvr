<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $item->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL Tujuan</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $item->url ?? '') }}" placeholder="Cth: /tentang-kami atau https://google.com">
            <div class="form-text">Bisa menggunakan path relative (misal: `/fasilitas`) atau URL absolut (misal: `https://...`)</div>
            @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="parent_id" class="form-label">Menu Induk (Parent)</label>
                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">-- Tidak ada (Sebagai Menu Utama) --</option>
                    @foreach($parents ?? [] as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $item->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }} ({{ ucfirst($parent->type) }})
                        </option>
                    @endforeach
                </select>
                @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="icon" class="form-label">Icon (Opsional)</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $item->icon ?? '') }}" placeholder="Cth: fas fa-home">
                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Lokasi Tampil <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="header" {{ old('type', $item->type ?? '') == 'header' ? 'selected' : '' }}>Header (Navbar)</option>
                        <option value="footer" {{ old('type', $item->type ?? '') == 'footer' ? 'selected' : '' }}>Footer</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="target" class="form-label">Target Buka Link</label>
                    <select class="form-select @error('target') is-invalid @enderror" id="target" name="target">
                        <option value="_self" {{ old('target', $item->target ?? '') == '_self' ? 'selected' : '' }}>Tab Sama (_self)</option>
                        <option value="_blank" {{ old('target', $item->target ?? '') == '_blank' ? 'selected' : '' }}>Tab Baru (_blank)</option>
                    </select>
                    @error('target')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <label class="form-label">Status Tayang</label>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>

                <label for="order" class="form-label">Urutan (Semakin kecil semakin kiri/atas)</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $item->order ?? 0) }}" min="0">
            </div>
        </div>
    </div>
</div>
