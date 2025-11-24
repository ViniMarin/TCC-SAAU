@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="{{ route('admin.donations.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes da Doação</h1>
            <p class="text-muted mb-0">Resumo completo do registro financeiro.</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.donations.edit', $donation),
            'delete' => route('admin.donations.destroy', $donation),
            'deleteMessage' => 'Tem certeza que deseja remover esta doação?'
        ])
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-hand-holding-usd"></i></span>
                        <div>
                            <small class="text-uppercase text-muted">Valor recebido</small>
                            <h3 class="mb-0 text-success fw-bold">R$ {{ number_format($donation->amount, 2, ',', '.') }}</h3>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-tags"></i></span>
                        <div>
                            <small class="text-uppercase text-muted">Tipo de doação</small>
                            <div class="fw-semibold text-capitalize">{{ $donation->type }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-clipboard-list"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Registro</small>
                            <div class="fw-semibold">{{ $donation->created_at?->format('d/m/Y H:i') }}</div>
                            <small class="text-muted">Última atualização: {{ $donation->updated_at?->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-user"></i></span>
                        <div>
                            <h5 class="mb-0">Doador</h5>
                            <small class="text-muted">Identificação e contato.</small>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-uppercase text-muted">Nome</small>
                                <div class="fw-semibold">{{ $donation->donor_name ?? 'Anônimo' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-uppercase text-muted">Email</small>
                                <div class="fw-semibold">{{ $donation->donor_email ?? 'Email não informado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-align-left"></i></span>
                        <div>
                            <h5 class="mb-0">Descrição</h5>
                            <small class="text-muted">Notas adicionais sobre a doação.</small>
                        </div>
                    </div>
                    <p class="mb-0">{!! nl2br(e($donation->description ?? 'Nenhuma descrição informada.')) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
