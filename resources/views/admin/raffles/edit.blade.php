@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Rifa: {{ $raffle->title }}</h1>
        <a href="{{ route('admin.raffles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.raffles.update', $raffle) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $raffle->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description', $raffle->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prize" class="form-label">Prêmio</label>
                    <input type="text" class="form-control @error('prize') is-invalid @enderror" 
                           id="prize" name="prize" value="{{ old('prize', $raffle->prize) }}">
                    @error('prize')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ticket_price" class="form-label">Valor do Bilhete *</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="text" inputmode="decimal" class="form-control currency-input @error('ticket_price') is-invalid @enderror"
                                   id="ticket_price" name="ticket_price" value="{{ old('ticket_price', number_format($raffle->ticket_price, 2, ',', '.')) }}" required>
                        </div>
                        @error('ticket_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="total_tickets" class="form-label">Total de Bilhetes *</label>
                        <input type="number" min="1" class="form-control @error('total_tickets') is-invalid @enderror"
                               id="total_tickets" name="total_tickets" value="{{ old('total_tickets', $raffle->total_tickets) }}" required>
                        @error('total_tickets')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @php
                    $drawDateValue = old('draw_date');

                    if (!$drawDateValue && $raffle->draw_date) {
                        $drawDateValue = $raffle->draw_date->format('Y-m-d');
                    }

                    if ($drawDateValue) {
                        try {
                            $drawDateValue = \Carbon\Carbon::parse($drawDateValue)->format('d/m/Y');
                        } catch (Exception) {
                            $drawDateValue = $drawDateValue;
                        }
                    }
                @endphp

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="draw_date" class="form-label">Data do Sorteio *</label>
                        <input type="text" inputmode="numeric" maxlength="10" placeholder="DD/MM/AAAA"
                               class="form-control @error('draw_date') is-invalid @enderror"
                               id="draw_date" name="draw_date" value="{{ $drawDateValue }}" required>
                        @error('draw_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                            <option value="ativa" {{ old('status', $raffle->status) == 'ativa' ? 'selected' : '' }}>Ativa</option>
                            <option value="pausada" {{ old('status', $raffle->status) == 'pausada' ? 'selected' : '' }}>Pausada</option>
                            <option value="encerrada" {{ old('status', $raffle->status) == 'encerrada' ? 'selected' : '' }}>Encerrada</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if($raffle->image_url)
                <div class="mb-3">
                    <label class="form-label">Imagem Atual</label>
                    <div>
                        <img src="{{ $raffle->image_url }}" alt="{{ $raffle->title }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">{{ $raffle->image_url ? 'Alterar Imagem' : 'Adicionar Imagem' }}</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('admin.raffles.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const formatCurrencyInput = (input) => {
        let value = input.value.replace(/\D/g, '');
        value = (parseInt(value, 10) || 0) / 100;
        input.value = value.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    };

    const setupCurrencyInputs = () => {
        document.querySelectorAll('.currency-input').forEach((input) => {
            formatCurrencyInput(input);
            input.addEventListener('input', () => formatCurrencyInput(input));
            input.addEventListener('blur', () => formatCurrencyInput(input));
        });
    };

    const maskDrawDate = (input) => {
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

    const setupDrawDate = () => {
        const drawDateInput = document.getElementById('draw_date');
        if (!drawDateInput) return;

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const validateDate = () => {
            const isoDate = toISODate(drawDateInput.value);
            if (!isoDate) {
                drawDateInput.setCustomValidity('Use o formato DD/MM/AAAA.');
                return false;
            }

            const chosenDate = new Date(isoDate);
            if (chosenDate < today) {
                drawDateInput.setCustomValidity('A data deve ser igual ou posterior à data atual.');
                return false;
            }

            drawDateInput.setCustomValidity('');
            return isoDate;
        };

        drawDateInput.addEventListener('input', () => maskDrawDate(drawDateInput));
        drawDateInput.addEventListener('blur', validateDate);

        const form = drawDateInput.closest('form');
        form?.addEventListener('submit', (event) => {
            const isoDate = validateDate();
            if (!isoDate) {
                event.preventDefault();
                drawDateInput.reportValidity();
                return;
            }

            drawDateInput.value = isoDate;
        });
    };

    document.addEventListener('DOMContentLoaded', () => {
        setupCurrencyInputs();
        setupDrawDate();
    });
</script>
@endsection
