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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="border rounded-3 p-3 h-100 text-start bg-white shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="fas fa-user"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Usuário</small>
                                <h5 class="mb-0">{{ $user->name }}</h5>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 mb-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-{{ $user->role == 'admin' ? 'danger-subtle text-danger' : ($user->role == 'veterinario' ? 'info-subtle text-info' : 'secondary-subtle text-secondary') }} rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-user-shield"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Papel</small>
                                <div class="fw-semibold mb-0">{{ ucfirst($user->role) }}</div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-envelope"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Email</small>
                                <div class="mb-0">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Data de cadastro</small>
                                        <h5 class="mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</h5>
                                    </div>
                                </div>
                                <small class="text-muted">Momento em que o usuário foi criado.</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                                        <h5 class="mb-0">{{ $user->updated_at->format('d/m/Y H:i') }}</h5>
                                    </div>
                                </div>
                                <small class="text-muted">Alterações recentes no perfil.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 border rounded-3 bg-white shadow-sm h-100">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-user-shield"></i></span>
                                    <div class="text-start">
                                        <small class="text-uppercase text-muted fw-semibold">Acesso</small>
                                        <p class="mb-0">Este usuário possui permissões de <strong>{{ ucfirst($user->role) }}</strong> no painel administrativo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
