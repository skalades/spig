<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerifiedAlumniMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->is_verified && !Auth::user()->isAdmin()) {
            return redirect()->route('alumni.dashboard')
                ->with('error', 'Akun Anda belum terverifikasi. Silakan lengkapi profil dan tunggu verifikasi admin.');
        }

        return $next($request);
    }
}
