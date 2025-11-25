<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        // Se já estiver logado como admin, manda pro dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        // 1) Validação básica (mensagem genérica)
        $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required'    => 'Login ou senha inválidos.',
                'email.email'       => 'Login ou senha inválidos.',
                'password.required' => 'Login ou senha inválidos.',
            ]
        );

        $email    = $request->input('email');
        $password = $request->input('password');

        // 2) Regra da senha (8+ caracteres, 1 maiúscula, 1 especial)
        if (!preg_match('/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
            return back()
                ->withErrors(['email' => 'Login ou senha inválidos.'])
                ->onlyInput('email');
        }

        // 3) Tentativa de login no guard admin
        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('admin')->user();

            // Apenas perfis autorizados
            if (!in_array($user->role, ['admin', 'veterinario', 'usuario'])) {
                Auth::guard('admin')->logout();

                return back()
                    ->withErrors(['email' => 'Acesso negado.'])
                    ->onlyInput('email');
            }

            // Regenera só o ID da sessão (não limpa tudo)
            $request->session()->regenerate();

            // Garante que no painel o guard admin seja usado
            Auth::shouldUse('admin');

            return redirect()->intended(route('admin.dashboard'));
        }

        // 4) Falha no login
        return back()
            ->withErrors(['email' => 'Login ou senha inválidos.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Faz logout só do guard admin
        Auth::guard('admin')->logout();

        // Importante: NÃO chamar ->invalidate()
        // senão derruba também o login do guard web.
        $request->session()->regenerate();      // novo ID
        $request->session()->regenerateToken(); // novo token CSRF

        return redirect()->route('admin.login');
    }
}
