<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // lista todos os perfis internos do painel
        $users = User::whereIn('role', ['admin', 'veterinario', 'usuario'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    // pelo menos 1 maiúscula e 1 caractere especial
                    'regex:/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).+$/',
                ],
                'role'     => 'required|in:admin,veterinario,usuario',
            ],
            [
                'email.unique'   => 'Este e-mail já está cadastrado.',
                'password.min'   => 'A senha deve ter pelo menos 8 caracteres.',
                'password.regex' => 'A senha deve ter pelo menos 8 caracteres, com ao menos 1 letra maiúscula e 1 caractere especial.',
            ]
        );

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).+$/',
                ],
                'role'     => 'required|in:admin,veterinario,usuario',
            ],
            [
                'email.unique'   => 'Este e-mail já está cadastrado.',
                'password.min'   => 'A nova senha deve ter pelo menos 8 caracteres.',
                'password.regex' => 'A nova senha deve ter pelo menos 8 caracteres, com ao menos 1 letra maiúscula e 1 caractere especial.',
            ]
        );

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        // Não permitir deletar o próprio usuário logado no painel
        if ($user->id === auth('admin')->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Você não pode deletar sua própria conta!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário removido com sucesso!');
    }
}
