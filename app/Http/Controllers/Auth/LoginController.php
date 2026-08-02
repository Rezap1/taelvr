<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Cek apakah user aktif dan punya akses admin
            if (!$user->hasAdminAccess()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak aktif atau tidak memiliki akses.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // Update last login
            $user->update(['last_login_at' => now()]);

            // Catat login log
            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'browser' => $request->userAgent(),
                'login_at' => now(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Update log logout terakhir
            $latestLog = LoginLog::where('user_id', $user->id)
                ->orderBy('login_at', 'desc')
                ->first();
                
            if ($latestLog) {
                $latestLog->update(['logout_at' => now()]);
            }
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
