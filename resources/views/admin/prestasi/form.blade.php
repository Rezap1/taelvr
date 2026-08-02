<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Prestasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $item->judul ?? '') }}" required>
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="program_studi_id" class="form-label">Program Studi</label>
            <select class="form-select @error('program_studi_id') is-invalid @enderror" id="program_studi_id" name="program_studi_id">
                <option value="">-- Pilih Program Studi --</option>
                @foreach($programStudi ?? [] as $prodi)
                    <option value="{{ $prodi->id }}" {{ old('program_studi_id', $item->program_studi_id ?? '') == $prodi->id ? 'selected' : '' }}>
                        {{ $prodi->nama }}
                    </option>
                @endforeach
            </select>
            @error('program_studi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tingkat" class="form-label">Tingkat Prestasi</label>
                <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat">
                    <option value="">Pilih Tingkat...</option>
                    <option value="Internasional" {{ old('tingkat', $item->tingkat ?? '') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                    <option value="Nasional" {{ old('tingkat', $item->tingkat ?? '') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Provinsi" {{ old('tingkat', $item->tingkat ?? '') == 'Provinsi' ? 'selected' : '' }}>Provinsi/Regional</option>
                    <option value="Universitas" {{ old('tingkat', $item->tingkat ?? '') == 'Universitas' ? 'selected' : '' }}>Universitas/Lokal</option>
                </select>
                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $item->tanggal ?? '') }}">
                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="peraih" class="form-label">Peraih Prestasi (Nama Mahasiswa/Tim)</label>
            <input type="text" class="form-control @error('peraih') is-invalid @enderror" id="peraih" name="peraih" value="{{ old('peraih', $item->peraih ?? '') }}">
            @error('peraih')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi / Detail Prestasi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

        <div class="mb-3">
            <label for="gambar" class="form-label">Foto Prestasi (Opsional)</label>
            @if(isset($item) && $item->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px">
                </div>
            @endif
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*">
            <div class="form-text">Format: jpg, png, webp. Maks: 2MB.</div>
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
