@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Evento: {{ $event->title }}</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $event->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="4">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    $eventDateValue = old('date', $event->date?->format('Y-m-d'));
                    if ($eventDateValue) {
                        try {
                            $eventDateValue = \Carbon\Carbon::parse($eventDateValue)->format('d/m/Y');
                        } catch (Exception) {
                            $eventDateValue = $eventDateValue;
                        }
                    }

                    $startTimeValue = old('start_time', $event->start_time
                        ? \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i')
                        : ''
                    );
                @endphp

                <div class="row">
                    {{-- DATA --}}
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Data *</label>
                        <input type="text" inputmode="numeric" maxlength="10" placeholder="DD/MM/AAAA"
                               class="form-control @error('date') is-invalid @enderror"
                               id="date" name="date" value="{{ $eventDateValue }}" required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HORÁRIO DE INÍCIO --}}
                    <div class="col-md-4 mb-3">
                        <label for="start_time" class="form-label">Horário de início *</label>
                        <input type="time"
                               id="start_time"
                               name="start_time"
                               class="form-control @error('start_time') is-invalid @enderror"
                               value="{{ $startTimeValue }}"
                               required>
                        @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LOCAL --}}
                    <div class="col-md-4 mb-3">
                        <label for="location" class="form-label">Local</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location', $event->location) }}">
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if($event->image_url)
                <div class="mb-3">
                    <label class="form-label">Imagem Atual</label>
                    <div>
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">{{ $event->image_url ? 'Alterar Imagem' : 'Adicionar Imagem' }}</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active', $event->active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">
                        Evento Ativo
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const maskEventDate = (input) => {
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

    const setupEventDate = () => {
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

        dateInput.addEventListener('input', () => maskEventDate(dateInput));
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
        setupEventDate();
    });
</script>
@endsection
