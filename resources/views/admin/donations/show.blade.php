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

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Valor</h6>
                    <p class="mb-0 text-success fw-bold">R$ {{ number_format($donation->amount, 2, ',', '.') }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Tipo</h6>
                    <p class="mb-0 text-capitalize">{{ $donation->type }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Doador</h6>
                    <p class="mb-0">{{ $donation->donor_name ?? 'Anônimo' }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Email do Doador</h6>
                    <p class="mb-0">{{ $donation->donor_email ?? '-' }}</p>
                </div>
                <div class="col-12">
                    <h6 class="text-muted mb-1">Descrição</h6>
                    <p class="mb-0">{{ $donation->description ?? 'Nenhuma descrição informada.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
