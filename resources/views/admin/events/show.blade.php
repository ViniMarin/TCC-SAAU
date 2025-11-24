@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="{{ route('admin.events.index') }}" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">{{ $event->title }}</h1>
            <p class="text-muted mb-0">Detalhes completos do evento e status de publicação.</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.events.edit', $event),
            'delete' => route('admin.events.destroy', $event),
            'deleteMessage' => 'Tem certeza que deseja remover este evento?'
        ])
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3 text-center">
                <div class="card-body">
                    @if($event->image_url)
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="img-fluid rounded mb-3" style="max-height: 240px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 240px;">
                        <i class="fas fa-calendar fa-3x text-muted"></i>
                    </div>
                    @endif
                    <div class="d-grid gap-2 text-start">
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-{{ $event->active ? 'success-subtle text-success' : 'secondary-subtle text-secondary' }} rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-flag"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Status</small>
                                <div class="fw-semibold mb-0">{{ $event->active ? 'Ativo' : 'Inativo' }}</div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-check"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Data</small>
                                <div class="fw-semibold mb-0">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Local</small>
                                <div class="fw-semibold mb-0">{{ $event->location ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Criado em</small>
                            <div class="fw-semibold">{{ $event->created_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                            <div class="fw-semibold">{{ $event->updated_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;"><i class="fas fa-align-left"></i></span>
                        <div>
                            <h5 class="mb-0">Descrição</h5>
                            <small class="text-muted">Contexto e informações gerais.</small>
                        </div>
                    </div>
                    <p class="mb-0">{!! nl2br(e($event->description ?? 'Nenhuma descrição informada.')) !!}</p>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3">
                        <div class="border rounded-3 p-3 bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Criado em</small>
                                    <div class="fw-semibold mb-0">{{ $event->created_at?->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                            <p class="text-muted mb-0 small">Registro inicial do evento.</p>
                        </div>
                        <div class="border rounded-3 p-3 bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                                    <div class="fw-semibold mb-0">{{ $event->updated_at?->format('d/m/Y H:i') }}</div>
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
@endsection
