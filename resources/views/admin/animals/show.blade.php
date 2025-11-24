@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.animals.index') }}" class="text-decoration-none text-secondary">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Detalhes do Animal</h1>
            <p class="text-muted mb-0">{{ $animal->name }}</p>
        </div>
        @include('admin.partials.action-buttons', [
            'edit' => route('admin.animals.edit', $animal),
            'delete' => route('admin.animals.destroy', $animal),
            'deleteMessage' => 'Tem certeza que deseja remover este animal?'
        ])
    </div>

    <div class="card">
        <div class="card-body row">
            <div class="col-md-4 mb-4 mb-md-0 text-center">
                @if($animal->photo_url)
                <img src="{{ $animal->photo_url }}" alt="{{ $animal->name }}" class="img-fluid rounded" style="max-height: 280px; object-fit: cover;">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 280px;">
                    <i class="fas fa-paw fa-3x text-muted"></i>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Espécie</h6>
                        <p class="mb-0">{{ ucfirst($animal->species) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Raça</h6>
                        <p class="mb-0">{{ $animal->breed ?? '-' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Idade</h6>
                        <p class="mb-0">{{ ucfirst($animal->age) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Sexo</h6>
                        <p class="mb-0">{{ $animal->gender === 'macho' ? 'Macho' : 'Fêmea' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Porte</h6>
                        <p class="mb-0">{{ ucfirst($animal->size) }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Cor</h6>
                        <p class="mb-0">{{ $animal->color ?? '-' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Status</h6>
                        <span class="badge bg-{{ $animal->status == 'disponivel' ? 'success' : ($animal->status == 'adotado' ? 'info' : 'warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $animal->status)) }}
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Saúde</h6>
                        <p class="mb-0">{{ $animal->health_status ?? '-' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Vacinas</h6>
                        <p class="mb-0">{{ $animal->vaccinated ? 'Em dia' : 'Pendente' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Vermifugado</h6>
                        <p class="mb-0">{{ $animal->dewormed ? 'Sim' : 'Não' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Castrado</h6>
                        <p class="mb-0">{{ $animal->castrated ? 'Sim' : 'Não' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Necessidades Especiais</h6>
                        <p class="mb-0">{{ $animal->special_needs ? 'Sim' : 'Não' }}</p>
                    </div>
                    <div class="col-12">
                        <h6 class="text-muted mb-1">Descrição</h6>
                        <p class="mb-0">{{ $animal->description ?? 'Nenhuma descrição informada.' }}</p>
                    </div>
                    <div class="col-12">
                        <h6 class="text-muted mb-1">Observações de Saúde</h6>
                        <p class="mb-0">{{ $animal->health_notes ?? 'Nenhuma observação adicional.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
