@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Editar Vacina</h1>
</div>

<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Atualizar Informações da Vacina</h2>
        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <form action="{{ route('admin.vaccines.update', $vaccine->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="animal_id" class="form-label">Animal *</label>
            <select class="form-select @error('animal_id') is-invalid @enderror" 
                    id="animal_id" name="animal_id" required>
                <option value="">Selecione um animal...</option>
                @foreach($animals as $animal)
                <option value="{{ $animal->id }}" {{ old('animal_id', $vaccine->animal_id) == $animal->id ? 'selected' : '' }}>
                    {{ $animal->name }} - {{ ucfirst($animal->species) }}
                </option>
                @endforeach
            </select>
            @error('animal_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="vaccine_type" class="form-label">Tipo de Vacina *</label>
            <input type="text" class="form-control @error('vaccine_type') is-invalid @enderror" 
                   id="vaccine_type" name="vaccine_type" value="{{ old('vaccine_type', $vaccine->vaccine_type) }}" 
                   placeholder="Ex: V10, Antirrábica, etc." required>
            @error('vaccine_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="application_date" class="form-label">Data de Aplicação *</label>
                <input type="date" class="form-control @error('application_date') is-invalid @enderror" 
                       id="application_date" name="application_date" value="{{ old('application_date', $vaccine->application_date) }}" required>
                @error('application_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="next_dose_date" class="form-label">Próxima Dose</label>
                <input type="date" class="form-control @error('next_dose_date') is-invalid @enderror" 
                       id="next_dose_date" name="next_dose_date" value="{{ old('next_dose_date', $vaccine->next_dose_date) }}">
                @error('next_dose_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Observações</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" 
                      id="notes" name="notes" rows="3">{{ old('notes', $vaccine->notes) }}</textarea>
            @error('notes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Atualizar Vacina
            </button>
            <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
