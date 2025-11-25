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
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $adminGuard = Auth::guard('admin');

        if ($adminGuard->attempt($credentials, $request->filled('remember'))) {
            $user = $adminGuard->user();

            // ✅ Agora permitem admin, veterinario e usuario
            if (in_array($user->role, ['admin', 'veterinario', 'usuario'])) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // Se cair aqui, é um papel não autorizado
            $adminGuard->logout();

            return back()->with('error', 'Acesso negado. Apenas perfis autorizados podem acessar esta área.');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
