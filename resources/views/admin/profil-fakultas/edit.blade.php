@extends('layouts.admin')

@section('title', 'Profil Fakultas')

@section('breadcrumb')
    <h4 class="mb-0">Profil Fakultas</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil Fakultas</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card card-modern border-0 shadow-sm">
    <div class="card-header bg-transparent border-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Update Profil Fakultas</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profil-fakultas.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul / Nama Fakultas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $profil->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="3">{{ old('visi', $profil->visi) }}</textarea>
                            @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="3">{{ old('misi', $profil->misi) }}</textarea>
                            @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <textarea class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" rows="3">{{ old('tujuan', $profil->tujuan) }}</textarea>
                        @error('tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="sejarah" class="form-label">Sejarah Fakultas</label>
                        <textarea class="form-control @error('sejarah') is-invalid @enderror" id="sejarah" name="sejarah" rows="5">{{ old('sejarah', $profil->sejarah) }}</textarea>
                        @error('sejarah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <h5 class="fw-bold mt-4 mb-3 border-bottom pb-2">Struktur & Pimpinan</h5>
                    
                    <div class="mb-3">
                        <label for="nama_pimpinan" class="form-label">Nama Dekan / Pimpinan</label>
                        <input type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="nama_pimpinan" name="nama_pimpinan" value="{{ old('nama_pimpinan', $profil->nama_pimpinan) }}">
                        @error('nama_pimpinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foto_pimpinan" class="form-label">Foto Dekan</label>
                            @if($profil->foto_pimpinan)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$profil->foto_pimpinan) }}" alt="Preview" class="img-thumbnail" style="max-height: 100px">
                                </div>
                            @endif
                            <input class="form-control @error('foto_pimpinan') is-invalid @enderror" type="file" id="foto_pimpinan" name="foto_pimpinan" accept="image/*">
                            @error('foto_pimpinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="struktur_organisasi" class="form-label">Struktur Organisasi</label>
                            @if($profil->struktur_organisasi)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$profil->struktur_organisasi) }}" alt="Preview" class="img-thumbnail" style="max-height: 100px">
                                </div>
                            @endif
                            <input class="form-control @error('struktur_organisasi') is-invalid @enderror" type="file" id="struktur_organisasi" name="struktur_organisasi" accept="image/*">
                            @error('struktur_organisasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <label class="form-label">Status Tayang</label>
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $profil->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fs-6 mt-1" for="is_active">Aktif (Tampil di Frontend)</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Gedung / Cover</label>
                        @if($profil->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$profil->gambar) }}" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                            </div>
                        @endif
                        <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Format: jpg, png, webp. Maks: 2MB.</div>
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
