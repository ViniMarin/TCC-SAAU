<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Para onde redirecionar depois do login.
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * LOGIN do site público com mesma regra de senha do admin.
     */
    public function login(Request $request)
    {
        // 1) Validação básica
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required'    => 'Informe o e-mail.',
                'email.email'       => 'Informe um e-mail válido.',
                'password.required' => 'Informe a senha.',
            ]
        );

        // 2) Regra de complexidade da senha
        $password = $credentials['password'];

        if (!preg_match('/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
            return back()->withErrors([
                'email' => 'Login ou senha inválidos.',
            ])->onlyInput('email');
        }

        // 3) Tentativa de login no guard padrão (web)
        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPath());
        }

        // 4) Falhou
        return back()->withErrors([
            'email' => 'Login ou senha inválidos.',
        ])->onlyInput('email');
    }

    /**
     * LOGOUT do site público
     * (não derruba o painel admin).
     */
    public function logout(Request $request)
    {
        // Sai só do guard web
        Auth::guard('web')->logout();

        // Não usamos ->invalidate() aqui
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
