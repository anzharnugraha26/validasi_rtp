<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        // Cek jika role user cocok
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
