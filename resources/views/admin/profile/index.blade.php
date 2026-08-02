@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('breadcrumb')
    <h4 class="mb-0">Profil</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil Pengguna</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-modern border-0 shadow-sm mb-4 text-center pt-4 pb-3">
            <div class="card-body">
                <div class="position-relative d-inline-block mb-3">
                    @if($user->avatar)
                        <img src="{{ asset('storage/'.$user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 120px; height: 120px; font-size: 40px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                <span class="badge bg-primary px-3 py-2 rounded-pill">{{ ucfirst($user->role ?? 'Administrator') }}</span>
                
                <hr class="my-4">
                
                <div class="text-start">
                    <p class="mb-2 text-muted small fw-bold text-uppercase">Informasi Akun</p>
                    <p class="mb-2"><i class="fas fa-calendar-alt me-2 text-primary"></i> Terdaftar: <span class="fw-semibold">{{ $user->created_at->format('d M Y') }}</span></p>
                    <p class="mb-0"><i class="fas fa-sign-in-alt me-2 text-primary"></i> Login Terakhir: <span class="fw-semibold">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : '-' }}</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card card-modern border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                <h6 class="fw-bold mb-0">Edit Profil</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="avatar" class="form-label">Ubah Avatar (Opsional)</label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto profil.</div>
                            @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Profil</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card card-modern border-0 shadow-sm border-top border-warning border-3">
            <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                <h6 class="fw-bold text-warning mb-0"><i class="fas fa-lock me-2"></i>Ganti Password</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                        @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    
                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-warning text-dark fw-bold"><i class="fas fa-key me-1"></i> Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
