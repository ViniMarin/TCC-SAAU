<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $adminGuard = Auth::guard('admin');

        if ($adminGuard->attempt($credentials, $request->filled('remember'))) {
            $user = $adminGuard->user();

            // Verificar se é admin ou veterinário
            if ($user->role === 'admin' || $user->role === 'veterinario') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // Se for usuário comum, faz logout e retorna erro

            $adminGuard->logout();
            return back()->with('error', 'Acesso negado. Apenas administradores e veterinários podem acessar esta área.');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->regenerate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
