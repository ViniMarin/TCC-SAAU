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
        // 1) Validação básica dos campos (sem expor regra de senha)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Login ou senha inválidos.',
            'email.email'       => 'Login ou senha inválidos.',
            'password.required' => 'Login ou senha inválidos.',
        ]);

        $email    = $request->input('email');
        $password = $request->input('password');

        // 2) Regra de complexidade da senha (8+ caracteres, 1 maiúscula, 1 especial)
        $regex = '/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/';

        if (!preg_match($regex, $password)) {
            // Mensagem genérica, não mostra a regra
            return back()
                ->withErrors(['email' => 'Login ou senha inválidos.'])
                ->onlyInput('email');
        }

        // 3) Tentativa de login no guard "admin"
        $adminGuard   = Auth::guard('admin');
        $credentials  = ['email' => $email, 'password' => $password];

        if ($adminGuard->attempt($credentials, $request->filled('remember'))) {
            $user = $adminGuard->user();

            // Perfis autorizados
            if (in_array($user->role, ['admin', 'veterinario', 'usuario'])) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // Papel não autorizado
            $adminGuard->logout();

            return back()->with('error', 'Acesso negado. Apenas perfis autorizados podem acessar esta área.');
        }

        // 4) Credenciais incorretas
        return back()
            ->withErrors(['email' => 'Login ou senha inválidos.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
