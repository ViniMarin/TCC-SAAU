<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Sempre usar o guard "admin" dentro do painel
        $adminGuard = Auth::guard('admin');
        Auth::shouldUse('admin');

        // Se não estiver logado no guard admin, manda pro login
        if (!$adminGuard->check()) {
            return redirect()->route('admin.login');
        }

        $user = $adminGuard->user();

        // Agora aceitamos admin, veterinario e usuario
        if (!in_array($user->role, ['admin', 'veterinario', 'usuario'])) {
            $adminGuard->logout();

            return redirect()
                ->route('admin.login')
                ->with('error', 'Acesso negado. Apenas perfis autorizados podem acessar esta área.');
        }

        // Garante que o restante da requisição use o guard de admin
        Auth::shouldUse('admin');

        return $next($request);
    }
}
