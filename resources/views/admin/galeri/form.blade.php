<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Galeri <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $item->judul ?? '') }}" required>
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="kategori_galeri_id" class="form-label">Kategori <span class="text-danger">*</span></label>
            <select class="form-select @error('kategori_galeri_id') is-invalid @enderror" id="kategori_galeri_id" name="kategori_galeri_id" required>
                <option value="">Pilih Kategori...</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_galeri_id', $item->kategori_galeri_id ?? '') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_galeri_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Upload File Galeri (Gambar/Video) <span class="text-danger">*</span></label>
            @if(isset($item) && $item->file_path)
                <div class="mb-2">
                    @if($item->file_type == 'image')
                        <img src="{{ asset('storage/'.$item->file_path) }}" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                    @else
                        <div class="alert alert-info">Video saat ini sudah terupload. Upload baru untuk menggantinya.</div>
                    @endif
                </div>
            @endif
            <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" accept="image/*,video/mp4" {{ !isset($item) ? 'required' : '' }}>
            <div class="form-text">Format: jpg, png, webp, mp4. Maks: 20MB.</div>
            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
