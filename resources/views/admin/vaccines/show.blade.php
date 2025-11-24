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

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Animal</h6>
                    <p class="mb-0">{{ $vaccine->animal->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Tipo de Vacina</h6>
                    <p class="mb-0">{{ $vaccine->vaccine_type }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Data de Aplicação</h6>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($vaccine->application_date)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-1">Próxima Dose</h6>
                    <p class="mb-0">{{ $vaccine->next_dose_date ? \Carbon\Carbon::parse($vaccine->next_dose_date)->format('d/m/Y') : '-' }}</p>
                </div>
                <div class="col-12">
                    <h6 class="text-muted mb-1">Observações</h6>
                    <p class="mb-0">{{ $vaccine->notes ?? 'Nenhuma observação adicionada.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
