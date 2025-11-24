@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.donations.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes da Doação</h1>
            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.donations.edit', $donation),
            'delete' => route('admin.donations.destroy', $donation),
            'deleteMessage' => 'Tem certeza que deseja remover esta doação?'
        ])
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-hand-holding-usd"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Valor recebido</small>
                                <h4 class="mb-0 text-success fw-bold">R$ {{ number_format($donation->amount, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                        <small class="text-muted">Data: {{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-tags"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Tipo de doação</small>
                                <h5 class="mb-0 text-capitalize">{{ $donation->type }}</h5>
                            </div>
                        </div>
                        <small class="text-muted">Classificação para relatórios.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-clipboard-list"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Registro</small>
                                <h5 class="mb-0">{{ $donation->created_at?->format('d/m/Y H:i') }}</h5>
                            </div>
                        </div>
                        <small class="text-muted">Última atualização: {{ $donation->updated_at?->format('d/m/Y H:i') }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-user"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Doador</small>
                                <h5 class="mb-1">{{ $donation->donor_name ?? 'Anônimo' }}</h5>
                                <p class="mb-0 text-muted">{{ $donation->donor_email ?? 'Email não informado' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100 bg-white shadow-sm">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-align-left"></i></span>
                            <div>
                                <small class="text-uppercase text-muted fw-semibold">Descrição</small>
                                <p class="mb-0">{!! nl2br(e($donation->description ?? 'Nenhuma descrição informada.')) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
