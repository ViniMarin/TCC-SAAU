@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.vaccines.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes da Vacina</h1>
            <p class="text-muted mb-0">{{ $vaccine->vaccine_type }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.vaccines.edit', $vaccine),
            'delete' => route('admin.vaccines.destroy', $vaccine),
            'deleteMessage' => 'Tem certeza que deseja remover este registro?'
        ])
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="fas fa-syringe"></i></span>
                            <div>
                                <p class="text-muted mb-1">Tipo de vacina</p>
                                <h5 class="mb-0">{{ $vaccine->vaccine_type }}</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-paw"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Animal</small>
                                <p class="mb-0 fw-semibold">{{ $vaccine->animal->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-user-md"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Registrado por</small>
                                <p class="mb-0 fw-semibold">{{ $vaccine->created_by ?? 'Não informado' }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Cadastro</small>
                                <p class="mb-0 fw-semibold">{{ $vaccine->created_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-2 mt-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                                <p class="mb-0 fw-semibold">{{ $vaccine->updated_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
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
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
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

                        <div class="col-12">
                            <div class="border rounded-3 p-3 bg-white shadow-sm">
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
        </div>
    </div>
</div>
@endsection
