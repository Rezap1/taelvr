<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $item->nama ?? '') }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="kaprodi" class="form-label">Ketua Program Studi</label>
            <input type="text" class="form-control @error('kaprodi') is-invalid @enderror" id="kaprodi" name="kaprodi" value="{{ old('kaprodi', $item->kaprodi ?? '') }}">
            @error('kaprodi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kode" class="form-label">Kode Prodi</label>
                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode', $item->kode ?? '') }}">
                @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                <select class="form-select @error('jenjang') is-invalid @enderror" id="jenjang" name="jenjang" required>
                    <option value="S1" {{ old('jenjang', $item->jenjang ?? '') == 'S1' ? 'selected' : '' }}>S1 - Sarjana</option>
                    <option value="S2" {{ old('jenjang', $item->jenjang ?? '') == 'S2' ? 'selected' : '' }}>S2 - Magister</option>
                    <option value="S3" {{ old('jenjang', $item->jenjang ?? '') == 'S3' ? 'selected' : '' }}>S3 - Doktor</option>
                    <option value="D3" {{ old('jenjang', $item->jenjang ?? '') == 'D3' ? 'selected' : '' }}>D3 - Diploma Tiga</option>
                    <option value="D4" {{ old('jenjang', $item->jenjang ?? '') == 'D4' ? 'selected' : '' }}>D4 - Sarjana Terapan</option>
                </select>
                @error('jenjang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="akreditasi" class="form-label">Akreditasi</label>
                <select class="form-select @error('akreditasi') is-invalid @enderror" id="akreditasi" name="akreditasi">
                    <option value="">Pilih Akreditasi...</option>
                    <option value="Unggul" {{ old('akreditasi', $item->akreditasi ?? '') == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                    <option value="A" {{ old('akreditasi', $item->akreditasi ?? '') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="Baik Sekali" {{ old('akreditasi', $item->akreditasi ?? '') == 'Baik Sekali' ? 'selected' : '' }}>Baik Sekali</option>
                    <option value="B" {{ old('akreditasi', $item->akreditasi ?? '') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="Baik" {{ old('akreditasi', $item->akreditasi ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="C" {{ old('akreditasi', $item->akreditasi ?? '') == 'C' ? 'selected' : '' }}>C</option>
                </select>
                @error('akreditasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="kuota" class="form-label">Kuota Mahasiswa Baru</label>
                <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota" name="kuota" value="{{ old('kuota', $item->kuota ?? '') }}" min="0">
                @error('kuota')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Profil Prodi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="prospek_karir" class="form-label">Prospek Karir Lulusan</label>
            <textarea class="form-control @error('prospek_karir') is-invalid @enderror" id="prospek_karir" name="prospek_karir" rows="3">{{ old('prospek_karir', $item->prospek_karir ?? '') }}</textarea>
            @error('prospek_karir')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                
                <label for="urutan" class="form-label">Urutan Tampil (Sort Order)</label>
                <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" min="0">
            </div>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Ikon / Logo Prodi</label>
            @if(isset($item) && $item->icon)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->icon) }}" alt="Preview Icon" class="img-thumbnail" style="max-height: 80px">
                </div>
            @endif
            <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" accept="image/*">
            <div class="form-text">Format: jpg, png, svg. Maks: 1MB.</div>
            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Header / Cover Prodi</label>
            @if(isset($item) && $item->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="Preview Gambar" class="img-thumbnail" style="max-height: 150px">
                </div>
            @endif
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*">
            <div class="form-text">Format: jpg, png. Maks: 2MB.</div>
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
