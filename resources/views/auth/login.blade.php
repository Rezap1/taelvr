@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card auth-card">
    <!-- Animated Gears -->
    <i class="fas fa-cog gear gear-1"></i>
    <i class="fas fa-cog gear gear-2"></i>
    <i class="fas fa-cog gear gear-3"></i>

    <div class="auth-header text-center">
        <img src="{{ asset('images/logo-unsur.png') }}" alt="Logo FT UNSUR" class="auth-logo" style="border-radius: 8px;">
        <h4 class="fw-bold mb-1" style="color: #1E3A8A; font-family: 'Outfit', sans-serif;">Administrator</h4>
        <p class="auth-subtitle">Masuk ke panel manajemen FT UNSUR</p>
    </div>
    <div class="auth-body">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3 position-relative z-2">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@ftunsur.ac.id">
                    @error('email')
                        <div class="invalid-feedback text-white">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 position-relative z-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label mb-0">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback text-white">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center position-relative z-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold position-relative z-2">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk
            </button>
            
            <div class="mt-4 text-center position-relative z-2">
                <a href="{{ route('home') }}" class="auth-link small">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
