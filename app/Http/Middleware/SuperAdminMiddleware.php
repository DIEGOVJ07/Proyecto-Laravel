<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     * Solo permite acceso a usuarios con rol super_admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->hasRole('super_admin')) {
            abort(403, 'Acceso denegado. Se requieren privilegios de Super Administrador.');
        }

        return $next($request);
    }
}
