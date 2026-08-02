<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, redirect ke halaman login admin
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika sudah login tapi tidak punya akses admin
        if (!Auth::user()->hasAdminAccess()) {
            abort(403, 'Anda tidak memiliki akses ke area ini.');
        }

        return $next($request);
    }
}
