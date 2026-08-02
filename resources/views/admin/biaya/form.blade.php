<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="program_studi_id" class="form-label">Program Studi <span class="text-danger">*</span></label>
            <select class="form-select @error('program_studi_id') is-invalid @enderror" id="program_studi_id" name="program_studi_id" required>
                <option value="">Pilih Program Studi...</option>
                @foreach($prodi as $p)
                    <option value="{{ $p->id }}" {{ old('program_studi_id', $item->program_studi_id ?? '') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
            @error('program_studi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jenis_biaya" class="form-label">Jenis Biaya <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('jenis_biaya') is-invalid @enderror" id="jenis_biaya" name="jenis_biaya" value="{{ old('jenis_biaya', $item->jenis_biaya ?? '') }}" placeholder="Contoh: UKT / Pendaftaran" required>
                @error('jenis_biaya')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', isset($item) ? intval($item->nominal) : '') }}" placeholder="Contoh: 5000000" min="0" required>
                @error('nominal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="periode" class="form-label">Periode Pembayaran</label>
            <input type="text" class="form-control @error('periode') is-invalid @enderror" id="periode" name="periode" value="{{ old('periode', $item->periode ?? '') }}" placeholder="Contoh: Per Semester / Satu Kali Masuk">
            @error('periode')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
