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

    <div class="card">
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
                </div>
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Prêmio</h6>
                            <p class="mb-0">{{ $raffle->prize ?: '-' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Valor do Bilhete</h6>
                            <p class="mb-0">R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Total de Bilhetes</h6>
                            <p class="mb-0">{{ $raffle->total_tickets }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Data do Sorteio</h6>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-1">Status</h6>
                            <span class="badge bg-{{ $raffle->status === 'ativa' ? 'success' : ($raffle->status === 'pausada' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($raffle->status) }}
                            </span>
                        </div>
                        <div class="col-12">
                            <h6 class="text-muted mb-1">Descrição</h6>
                            <p class="mb-0">{!! nl2br(e($raffle->description ?? 'Nenhuma descrição informada.')) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
