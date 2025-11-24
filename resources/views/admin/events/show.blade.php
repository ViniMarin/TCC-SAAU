@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.events.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes do Evento</h1>
            <p class="text-muted mb-0">{{ $event->title }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.events.edit', $event),
            'delete' => route('admin.events.destroy', $event),
            'deleteMessage' => 'Tem certeza que deseja remover este evento?'
        ])
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    @if($event->image_url)
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="img-fluid rounded" style="max-height: 240px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 240px;">
                        <i class="fas fa-calendar fa-3x text-muted"></i>
                    </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Data</h6>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Local</h6>
                            <p class="mb-0">{{ $event->location ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Status</h6>
                            <span class="badge bg-{{ $event->active ? 'success' : 'secondary' }}">{{ $event->active ? 'Ativo' : 'Inativo' }}</span>
                        </div>
                        <div class="col-12">
                            <h6 class="text-muted mb-1">Descrição</h6>
                            <p class="mb-0">{!! nl2br(e($event->description ?? 'Nenhuma descrição informada.')) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
