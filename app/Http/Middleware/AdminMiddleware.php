<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user login & role = admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return abort(403, 'Akses ditolak. Halaman khusus admin.');
        }

        return $next($request);
    }
}
