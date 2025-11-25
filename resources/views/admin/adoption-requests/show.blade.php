@extends('layouts.admin')

@section('title', 'Pedido de Adoção - SAAU')
@section('page-title', 'Pedido de Adoção')

@section('content')
<div class="container my-5">

    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="{{ route('admin.adoption-requests.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Pedido de Adoção</h1>
            <p class="text-muted mb-0">Reveja o cadastro, acompanhe mensagens e atualize o status deste pedido.</p>
        </div>

        @php
            $status = $adoptionRequest->status;
            $badgeClass = $status === 'aprovado'
                ? 'success'
                : ($status === 'rejeitado' ? 'danger' : 'warning');
        @endphp

        <div class="text-end">
            <span class="badge rounded-pill bg-{{ $badgeClass }} px-3 py-2 text-uppercase">
                <i class="fas fa-flag me-1"></i>{{ ucfirst($status) }}
            </span>
            <p class="text-muted small mb-0 mt-2">
                Recebido em {{ $adoptionRequest->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>

    <div class="row g-4">
        {{-- COLUNA ESQUERDA --}}
        <div class="col-lg-8">

            {{-- Informações do adotante --}}
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-user"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Informações do adotante</h5>
                            <small class="text-muted">Dados principais para contato e análise.</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Nome completo</small>
                                <span class="fw-semibold">
                                    {{ $adoptionRequest->adopter_name ?? 'Não informado' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Telefone</small>
                                <span class="fw-semibold">
                                    {{ $adoptionRequest->adopter_phone ?? 'Não informado' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">E-mail</small>
                                <span class="fw-semibold">
                                    {{ $adoptionRequest->adopter_email ?? 'Não informado' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Cidade / Estado</small>
                                <span class="fw-semibold">
                                    {{ $adoptionRequest->city_state ?? 'Não informado' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Animal solicitado --}}
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-paw"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Animal solicitado</h5>
                            <small class="text-muted">Resumo do perfil do pet vinculado.</small>
                        </div>
                    </div>

                    @if($adoptionRequest->animal)
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            @if($adoptionRequest->animal->photo_url)
                                <img src="{{ $adoptionRequest->animal->photo_url }}"
                                     alt="{{ $adoptionRequest->animal->name }}"
                                     class="rounded"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @endif

                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $adoptionRequest->animal->name }}</h5>
                                <div class="d-flex flex-wrap gap-2 small">
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ ucfirst($adoptionRequest->animal->species) }}
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $adoptionRequest->animal->breed ?? 'Raça não informada' }}
                                    </span>
                                    <span class="badge bg-info-subtle text-info">
                                        {{ $adoptionRequest->animal->age ?? 'Idade não informada' }}
                                    </span>
                                    @php
                                        $animalStatus = $adoptionRequest->animal->status ?? 'indefinido';
                                        $animalStatusClass = $animalStatus === 'disponivel'
                                            ? 'bg-success-subtle text-success'
                                            : 'bg-secondary-subtle text-secondary';
                                    @endphp
                                    <span class="badge {{ $animalStatusClass }}">
                                        {{ ucfirst($animalStatus) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Animal não encontrado ou removido.
                        </div>
                    @endif
                </div>
            </div>

            {{-- Mensagem do adotante --}}
            @if($adoptionRequest->message)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="bg-info-subtle text-info rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-comment-dots"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Mensagem do adotante</h5>
                                <small class="text-muted">Contexto e expectativas sobre a adoção.</small>
                            </div>
                        </div>
                        <p class="mb-0">{{ $adoptionRequest->message }}</p>
                    </div>
                </div>
            @endif

            {{-- Observações internas --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-sticky-note"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Observações internas</h5>
                            <small class="text-muted">Use para organizar o acompanhamento com a equipe.</small>
                        </div>
                    </div>
                    <p class="mb-0">{{ $adoptionRequest->admin_notes ?: 'Nenhuma observação registrada.' }}</p>
                </div>
            </div>
        </div>

        {{-- COLUNA DIREITA --}}
        <div class="col-lg-4">

            {{-- Resumo do pedido --}}
            @php
                $statusTextClass = $status === 'aprovado'
                    ? 'text-success'
                    : ($status === 'rejeitado' ? 'text-danger' : 'text-warning');
            @endphp

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Resumo do pedido</h5>
                    <dl class="row mb-0 small">
                        <dt class="col-5 text-muted">Status atual</dt>
                        <dd class="col-7 fw-semibold {{ $statusTextClass }}">
                            {{ ucfirst($status) }}
                        </dd>

                        <dt class="col-5 text-muted mt-2">Data de recebimento</dt>
                        <dd class="col-7 mt-2">
                            {{ $adoptionRequest->created_at->format('d/m/Y') }}
                        </dd>

                        @if($adoptionRequest->animal)
                            <dt class="col-5 text-muted mt-2">Animal</dt>
                            <dd class="col-7 mt-2">
                                {{ $adoptionRequest->animal->name }}
                            </dd>
                        @endif

                        <dt class="col-5 text-muted mt-2">Adotante</dt>
                        <dd class="col-7 mt-2">
                            {{ $adoptionRequest->adopter_name ?? 'Não informado' }}
                        </dd>
                    </dl>
                </div>
            </div>

            {{-- Atualizar andamento --}}
            @if($status === 'pendente')
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Atualizar andamento</h5>
                                <small class="text-muted">Defina se o pedido será aprovado ou rejeitado.</small>
                            </div>
                        </div>

                        <form action="{{ route('admin.adoption-requests.update', $adoptionRequest) }}" method="POST" class="vstack gap-3">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="status" class="form-label fw-semibold">Nova situação</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="aprovado">Aprovar pedido</option>
                                    <option value="rejeitado">Rejeitar pedido</option>
                                </select>
                                <small class="text-muted d-block mt-1">
                                    Após definir como Aprovado ou Rejeitado, novas alterações devem ser feitas pela tela de <strong>Editar</strong>.
                                </small>
                            </div>

                            <div>
                                <label for="admin_notes" class="form-label fw-semibold">Observações</label>
                                <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="Ex.: Motivo da aprovação ou pontos de atenção">{{ $adoptionRequest->admin_notes }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i> Salvar alterações
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-lock"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Andamento já definido</h5>
                                <small class="text-muted">
                                    Este pedido está <strong>{{ ucfirst($status) }}</strong>.  
                                    Para alterar o status ou as observações, utilize o botão <strong>Editar</strong> na lista de pedidos.
                                </small>
                            </div>
                        </div>

                        <a href="{{ route('admin.adoption-requests.edit', $adoptionRequest) }}" class="btn btn-outline-primary w-100 mt-3">
                            <i class="fas fa-edit me-1"></i> Ir para edição do pedido
                        </a>
                    </div>
                </div>
            @endif

            {{-- Excluir pedido --}}
            <div class="card shadow-sm border-0 bg-light-subtle">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-danger-subtle text-danger rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-trash"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Excluir pedido</h5>
                            <small class="text-muted">Remove definitivamente este registro.</small>
                        </div>
                    </div>

                    <form action="{{ route('admin.adoption-requests.destroy', $adoptionRequest) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-1"></i> Remover pedido
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
