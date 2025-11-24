@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Editar Doação</h1>
</div>

<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Atualizar Informações da Doação</h2>
        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
        @csrf
        @method('PUT')

        @php
            $dateValue = old('date');

            if (!$dateValue && $donation->date) {
                $dateValue = $donation->date->format('Y-m-d');
            }

            if ($dateValue) {
                try {
                    $dateValue = \Carbon\Carbon::parse($dateValue)->format('d/m/Y');
                } catch (Exception) {
                    $dateValue = $dateValue;
                }
            }
        @endphp

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date" class="form-label">Data *</label>
                <input type="text" inputmode="numeric" maxlength="10" placeholder="DD/MM/AAAA"
                       class="form-control @error('date') is-invalid @enderror"
                       id="date" name="date" value="{{ $dateValue }}" required>
                @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="amount" class="form-label">Valor (R$) *</label>
                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                       id="amount" name="amount" value="{{ old('amount', $donation->amount) }}" required>
                @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipo de Doação *</label>
            <select class="form-select @error('type') is-invalid @enderror" 
                    id="type" name="type" required>
                <option value="">Selecione...</option>
                <option value="dinheiro" {{ old('type', $donation->type) == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                <option value="racao" {{ old('type', $donation->type) == 'racao' ? 'selected' : '' }}>Ração</option>
                <option value="medicamento" {{ old('type', $donation->type) == 'medicamento' ? 'selected' : '' }}>Medicamento</option>
                <option value="outro" {{ old('type', $donation->type) == 'outro' ? 'selected' : '' }}>Outro</option>
            </select>
            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="donor_name" class="form-label">Nome do Doador</label>
            <input type="text" class="form-control @error('donor_name') is-invalid @enderror" 
                   id="donor_name" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" 
                   placeholder="Deixe em branco para anônimo">
            @error('donor_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="donor_email" class="form-label">E-mail do Doador</label>
            <input type="email" class="form-control @error('donor_email') is-invalid @enderror" 
                   id="donor_email" name="donor_email" value="{{ old('donor_email', $donation->donor_email) }}">
            @error('donor_email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Observações</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3">{{ old('description', $donation->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Atualizar Doação
            </button>
            <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const maskDate = (input) => {
        const digits = input.value.replace(/\D/g, '').slice(0, 8);
        const parts = [];

        if (digits.length > 0) parts.push(digits.substring(0, Math.min(2, digits.length)));
        if (digits.length >= 3) parts.push(digits.substring(2, Math.min(4, digits.length)));
        if (digits.length >= 5) parts.push(digits.substring(4, digits.length));

        input.value = parts.join('/');
    };

    const toISODate = (value) => {
        const match = value.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if (!match) return null;
        const [, day, month, year] = match;
        const isoDate = `${year}-${month}-${day}`;
        const parsed = new Date(isoDate);
        return Number.isNaN(parsed.getTime()) ? null : isoDate;
    };

    const setupDateInput = () => {
        const dateInput = document.getElementById('date');
        if (!dateInput) return;

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const validateDate = () => {
            const isoDate = toISODate(dateInput.value);
            if (!isoDate) {
                dateInput.setCustomValidity('Use o formato DD/MM/AAAA.');
                return false;
            }

            const chosenDate = new Date(isoDate);
            if (chosenDate < today) {
                dateInput.setCustomValidity('A data deve ser igual ou posterior à data atual.');
                return false;
            }

            dateInput.setCustomValidity('');
            return isoDate;
        };

        dateInput.addEventListener('input', () => maskDate(dateInput));
        dateInput.addEventListener('blur', validateDate);

        const form = dateInput.closest('form');
        form?.addEventListener('submit', (event) => {
            const isoDate = validateDate();
            if (!isoDate) {
                event.preventDefault();
                dateInput.reportValidity();
                return;
            }

            dateInput.value = isoDate;
        });
    };

    document.addEventListener('DOMContentLoaded', () => {
        setupDateInput();
    });
</script>
@endsection
