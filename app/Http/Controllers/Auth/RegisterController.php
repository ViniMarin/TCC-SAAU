<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Para onde redirecionar depois do registro.
     */
    protected $redirectTo = '/';

    /**
     * Criar uma nova instância do controller.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador dos dados de registro.
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    // pelo menos 1 maiúscula e 1 caractere especial
                    'regex:/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).+$/',
                    'confirmed',
                ],
            ],
            [
                'password.regex' => 'A senha deve ter pelo menos 8 caracteres, com ao menos 1 letra maiúscula e 1 caractere especial.',
                'password.confirmed' => 'A confirmação de senha não confere.',
            ]
        );
    }

    /**
     * Cria o usuário após validação.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'adotante',
        ]);
    }
}
