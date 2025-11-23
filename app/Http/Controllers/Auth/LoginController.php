<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Efetua o logout apenas do guard padrão (adotantes), mantendo outras sessões ativas.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->regenerate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect('/');
    }

    /**
     * Impede que usuários administrativos façam login pelo site principal.
     */
    protected function authenticated(Request $request, $user)
    {
        if (in_array($user->role, ['admin', 'veterinario'])) {
            $this->guard()->logout();

            $request->session()->regenerate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Acesso negado. Utilize o login administrativo para entrar.',
            ]);
        }
    }
}
