<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DualRoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Belum login');
        }

        if ($user->role === 'atasan' && $user->role2 === 'penerima') {
            return $next($request);
        }

        abort(403, 'Akses ditolak');
    }
}


