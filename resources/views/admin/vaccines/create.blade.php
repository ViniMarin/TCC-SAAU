@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Registrar Nova Vacina</h1>
        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.vaccines.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="animal_id" class="form-label">Animal *</label>
                    <select class="form-select @error('animal_id') is-invalid @enderror" 
                            id="animal_id" name="animal_id" required>
                        <option value="">Selecione um animal...</option>
                        @foreach($animals as $animal)
                        <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
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
                           id="vaccine_type" name="vaccine_type" value="{{ old('vaccine_type') }}" 
                           placeholder="Ex: V10, Antirrábica, etc." required>
                    @error('vaccine_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="application_date" class="form-label">Data de Aplicação *</label>
                        <input type="date" class="form-control @error('application_date') is-invalid @enderror" 
                               id="application_date" name="application_date" value="{{ old('application_date') }}" required>
                        @error('application_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="next_dose_date" class="form-label">Próxima Dose</label>
                        <input type="date" class="form-control @error('next_dose_date') is-invalid @enderror" 
                               id="next_dose_date" name="next_dose_date" value="{{ old('next_dose_date') }}">
                        @error('next_dose_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Observações</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Registrar Vacina
                    </button>
                    <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
