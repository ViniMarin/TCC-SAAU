@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="{{ route('admin.vaccines.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">{{ $vaccine->vaccine_type }}</h1>
            <p class="text-muted mb-0">Histórico da aplicação e acompanhamento.</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.vaccines.edit', $vaccine),
            'delete' => route('admin.vaccines.destroy', $vaccine),
            'deleteMessage' => 'Tem certeza que deseja remover este registro?'
        ])
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-syringe"></i></span>
                        <div>
                            <small class="text-uppercase text-muted">Tipo de vacina</small>
                            <h5 class="mb-0">{{ $vaccine->vaccine_type }}</h5>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-paw"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Animal</small>
                                <div class="fw-semibold mb-0">{{ $vaccine->animal->name ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-user-md"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Registrado por</small>
                                <div class="fw-semibold mb-0">{{ $vaccine->created_by ?? 'Não informado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Cadastro</small>
                            <div class="fw-semibold">{{ $vaccine->created_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                            <div class="fw-semibold">{{ $vaccine->updated_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-check"></i></span>
                                <div>
                                    <p class="text-muted mb-0">Data de aplicação</p>
                                    <h5 class="mb-0">{{ \Carbon\Carbon::parse($vaccine->application_date)->format('d/m/Y') }}</h5>
                                </div>
                            </div>
                            <small class="text-muted">Dose aplicada e registrada no sistema.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-bell"></i></span>
                                <div>
                                    <p class="text-muted mb-0">Próxima dose</p>
                                    <h5 class="mb-0">{{ $vaccine->next_dose_date ? \Carbon\Carbon::parse($vaccine->next_dose_date)->format('d/m/Y') : 'Sem agendamento' }}</h5>
                                </div>
                            </div>
                            <small class="text-muted">Mantenha os lembretes de reforço em dia.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-sticky-note"></i></span>
                        <div>
                            <h6 class="mb-0">Observações</h6>
                            <small class="text-muted">Detalhes adicionais do atendimento.</small>
                        </div>
                    </div>
                    <p class="mb-0">{!! nl2br(e($vaccine->notes ?? 'Nenhuma observação adicionada.')) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
