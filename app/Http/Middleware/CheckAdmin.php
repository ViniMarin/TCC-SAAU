<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $guard = Auth::guard('admin');

        if (!$guard->check()) {
            return redirect()->route('admin.login');
        }

        $user = $guard->user();

        if ($user->role !== 'admin' && $user->role !== 'veterinario') {
            $guard->logout();
            return redirect()->route('admin.login')
                ->with('error', 'Acesso negado. Apenas administradores e veterinários podem acessar esta área.');
        }

        // Garante que o restante da requisição use o guard de admin
        Auth::shouldUse('admin');

        return $next($request);
    }
}
