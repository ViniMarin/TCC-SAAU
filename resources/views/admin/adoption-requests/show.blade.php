@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="{{ route('admin.adoption-requests.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Pedido de Adoção</h1>
            <p class="text-muted mb-0">Reveja o cadastro, acompanhe mensagens e atualize o status.</p>
        </div>
        <div class="text-end">
            <span class="badge rounded-pill bg-{{ $adoptionRequest->status === 'aprovado' ? 'success' : ($adoptionRequest->status === 'rejeitado' ? 'danger' : 'warning') }} px-3 py-2 text-uppercase">
                <i class="fas fa-flag me-1"></i>{{ ucfirst($adoptionRequest->status) }}
            </span>
            <p class="text-muted small mb-0 mt-2">Recebido em {{ $adoptionRequest->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-user"></i></span>
                            <div>
                                <h5 class="mb-0">Informações do adotante</h5>
                                <small class="text-muted">Dados principais para contato e análise.</small>
                            </div>
                        </div>
                        <span class="badge bg-light text-secondary border">Pedido #{{ $adoptionRequest->id }}</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Nome completo</small>
                                <span class="fw-semibold">{{ $adoptionRequest->adopter_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Telefone</small>
                                <span class="fw-semibold">{{ $adoptionRequest->adopter_phone }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">E-mail</small>
                                <span class="fw-semibold">{{ $adoptionRequest->adopter_email }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Endereço</small>
                                <span class="fw-semibold">{{ $adoptionRequest->adopter_address ?? 'Não informado' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-paw"></i></span>
                        <div>
                            <h5 class="mb-0">Animal solicitado</h5>
                            <small class="text-muted">Resumo do perfil do pet vinculado.</small>
                        </div>
                    </div>
                    @if($adoptionRequest->animal)
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        @if($adoptionRequest->animal->photo_url)
                        <img src="{{ $adoptionRequest->animal->photo_url }}" alt="{{ $adoptionRequest->animal->name }}" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $adoptionRequest->animal->name }}</h5>
                            <div class="d-flex flex-wrap gap-2 small">
                                <span class="badge bg-primary-subtle text-primary">{{ ucfirst($adoptionRequest->animal->species) }}</span>
                                <span class="badge bg-secondary-subtle text-secondary">{{ $adoptionRequest->animal->breed ?? 'Raça não informada' }}</span>
                                <span class="badge bg-info-subtle text-info">{{ $adoptionRequest->animal->age ?? 'Idade não informada' }}</span>
                                <span class="badge bg-{{ $adoptionRequest->animal->status == 'disponivel' ? 'success-subtle text-success' : 'secondary-subtle text-secondary' }}">
                                    {{ ucfirst($adoptionRequest->animal->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning mb-0">Animal não encontrado ou removido.</div>
                    @endif
                </div>
            </div>

            @if($adoptionRequest->message)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="bg-info-subtle text-info rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-comment-dots"></i></span>
                        <div>
                            <h5 class="mb-0">Mensagem do adotante</h5>
                            <small class="text-muted">Contexto e expectativas sobre a adoção.</small>
                        </div>
                    </div>
                    <p class="mb-0">{{ $adoptionRequest->message }}</p>
                </div>
            </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-sticky-note"></i></span>
                        <div>
                            <h5 class="mb-0">Observações internas</h5>
                            <small class="text-muted">Use para organizar o acompanhamento com a equipe.</small>
                        </div>
                    </div>
                    <p class="mb-0">{{ $adoptionRequest->admin_notes ?: 'Nenhuma observação registrada.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-tasks"></i></span>
                        <div>
                            <h5 class="mb-0">Atualizar andamento</h5>
                            <small class="text-muted">Altere o status e registre comentários.</small>
                        </div>
                    </div>
                    <form action="{{ route('admin.adoption-requests.update', $adoptionRequest) }}" method="POST" class="vstack gap-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pendente" {{ $adoptionRequest->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="aprovado" {{ $adoptionRequest->status == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                                <option value="rejeitado" {{ $adoptionRequest->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                            </select>
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

            <div class="card shadow-sm border-0 bg-light-subtle">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-danger-subtle text-danger rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-trash"></i></span>
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
