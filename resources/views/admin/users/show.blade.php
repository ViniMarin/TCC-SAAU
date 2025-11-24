@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes do Usuário</h1>
            <p class="text-muted mb-0">{{ $user->name }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.users.edit', $user),
            'delete' => $user->id !== auth('admin')->id() ? route('admin.users.destroy', $user) : null,
            'deleteMessage' => 'Tem certeza que deseja remover este usuário?'
        ])
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Nome</h6>
                    <p class="mb-0">{{ $user->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Email</h6>
                    <p class="mb-0">{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Perfil</h6>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'veterinario' ? 'info' : 'secondary') }}">{{ ucfirst($user->role) }}</span>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Data de Cadastro</h6>
                    <p class="mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
