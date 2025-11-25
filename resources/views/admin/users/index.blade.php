@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Usuários</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Novo Usuário
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $roleLabels = [
            'admin'       => 'Admin',
            'veterinario' => 'Veterinário',
            'usuario'     => 'Usuário',
            'adotante'    => 'Adotante',
        ];

        $roleColors = [
            'admin'       => 'danger',
            'veterinario' => 'info',
            'usuario'     => 'primary',
            'adotante'    => 'secondary',
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $roleKey   = $user->role;
                                        $badge     = $roleColors[$roleKey] ?? 'secondary';
                                        $roleLabel = $roleLabels[$roleKey] ?? ucfirst($roleKey);
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($user->id !== auth('admin')->id())
                                        @include('admin.partials.action-buttons', [
                                            'view'          => route('admin.users.show', $user),
                                            'edit'          => route('admin.users.edit', $user->id),
                                            'delete'        => route('admin.users.destroy', $user),
                                            'deleteMessage' => 'Tem certeza que deseja remover este usuário?',
                                        ])
                                    @else
                                        @include('admin.partials.action-buttons', [
                                            'view' => route('admin.users.show', $user),
                                            'edit' => route('admin.users.edit', $user->id),
                                        ])
                                        <span class="badge bg-success ms-2">Você</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum usuário cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
