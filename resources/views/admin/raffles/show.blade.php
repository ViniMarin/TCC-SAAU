@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.raffles.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes da Rifa</h1>
            <p class="text-muted mb-0">{{ $raffle->title }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.raffles.edit', $raffle),
            'delete' => route('admin.raffles.destroy', $raffle),
            'deleteMessage' => 'Tem certeza que deseja remover esta rifa?'
        ])
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    @if($raffle->image_url)
                    <img src="{{ $raffle->image_url }}" alt="{{ $raffle->title }}" class="img-fluid rounded" style="max-height: 240px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 240px;">
                        <i class="fas fa-ticket-alt fa-3x text-muted"></i>
                    </div>
                    @endif
                    <div class="mt-3 text-start">
                        <div class="border rounded-3 p-3 bg-white shadow-sm d-flex align-items-center gap-2">
                            <span class="bg-{{ $raffle->status === 'ativa' ? 'success-subtle text-success' : ($raffle->status === 'pausada' ? 'warning-subtle text-warning' : 'secondary-subtle text-secondary') }} rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-flag"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Status</small>
                                <div class="fw-semibold mb-0">{{ ucfirst($raffle->status) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-gift"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Prêmio</small>
                                        <h5 class="mb-0">{{ $raffle->prize ?: '-' }}</h5>
                                    </div>
                                </div>
                                <small class="text-muted">O que o ganhador leva para casa.</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-white shadow-sm">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-day"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Data do sorteio</small>
                                        <h5 class="mb-0">{{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}</h5>
                                    </div>
                                </div>
                                <small class="text-muted">Organize a divulgação e entrega.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="border rounded-3 p-3 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-money-bill-wave"></i></span>
                                        <div>
                                            <small class="text-uppercase text-muted fw-semibold">Valor do bilhete</small>
                                            <div class="fw-semibold mb-0">R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</div>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0 small">Preço por número vendido.</p>
                                </div>
                                <div class="border rounded-3 p-3 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-ticket-alt"></i></span>
                                        <div>
                                            <small class="text-uppercase text-muted fw-semibold">Total de bilhetes</small>
                                            <div class="fw-semibold mb-0">{{ $raffle->total_tickets }}</div>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0 small">Capacidade máxima planejada.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded-3 p-3 bg-white shadow-sm">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-align-left"></i></span>
                                    <div>
                                        <h6 class="mb-0">Descrição</h6>
                                        <small class="text-muted">Histórico e detalhes da rifa.</small>
                                    </div>
                                </div>
                                <p class="mb-0">{!! nl2br(e($raffle->description ?? 'Nenhuma descrição informada.')) !!}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="border rounded-3 p-3 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                                        <div>
                                            <small class="text-uppercase text-muted fw-semibold">Criada em</small>
                                            <div class="fw-semibold mb-0">{{ $raffle->created_at?->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0 small">Registro inicial da rifa.</p>
                                </div>
                                <div class="border rounded-3 p-3 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                                        <div>
                                            <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                                            <div class="fw-semibold mb-0">{{ $raffle->updated_at?->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0 small">Alteração mais recente registrada.</p>
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
