<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Exemplo de uso:
     *  ->middleware('role:admin')
     *  ->middleware('role:admin,veterinario')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Sempre olhar para o guard "admin" no painel
        $user = Auth::guard('admin')->user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Você não tem permissão para acessar esta área.');
        }

        return $next($request);
    }
}
