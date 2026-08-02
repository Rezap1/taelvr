<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Informasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $item->judul ?? '') }}" required>
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi / Penjelasan Umum</label>
            <textarea class="form-control tinymce-editor @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="persyaratan" class="form-label">Persyaratan Pendaftaran</label>
            <textarea class="form-control tinymce-editor @error('persyaratan') is-invalid @enderror" id="persyaratan" name="persyaratan" rows="5">{{ old('persyaratan', $item->persyaratan ?? '') }}</textarea>
            @error('persyaratan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="alur_pendaftaran" class="form-label">Alur Pendaftaran</label>
            <textarea class="form-control tinymce-editor @error('alur_pendaftaran') is-invalid @enderror" id="alur_pendaftaran" name="alur_pendaftaran" rows="5">{{ old('alur_pendaftaran', $item->alur_pendaftaran ?? '') }}</textarea>
            @error('alur_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
            </div>
        </div>

        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <label for="link_pendaftaran" class="form-label">Link Eksternal Pendaftaran</label>
                <input type="url" class="form-control @error('link_pendaftaran') is-invalid @enderror" id="link_pendaftaran" name="link_pendaftaran" value="{{ old('link_pendaftaran', $item->link_pendaftaran ?? '') }}" placeholder="https://pmb.unsur.ac.id">
                <div class="form-text">Isi jika informasi ini diarahkan ke website PMB.</div>
                @error('link_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
