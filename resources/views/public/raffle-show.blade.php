@extends('layouts.app')

@section('title', 'Rifa - ' . $raffle->title)

{{-- TÍTULO NA FAIXA AZUL --}}
@section('header-content')
    <h1 class="page-header-title">RIFAS SOLIDÁRIAS</h1>
@endsection

@section('content')
<div class="container my-5">

    {{-- ALERTAS GERAIS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong>Ops!</strong> Verifique os campos abaixo.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $ticketsSold = $ticketsSold ?? 0;
        $remaining   = max($raffle->total_tickets - $ticketsSold, 0);
    @endphp

    <div class="row g-4">

        {{-- COLUNA ESQUERDA – DETALHES DA RIFA --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary"
                             style="width: 48px; height: 48px;">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <h2 class="h3 mb-1">{{ $raffle->title }}</h2>
                            <small class="text-muted">Confira os detalhes antes de participar.</small>
                        </div>
                    </div>

                    @if($raffle->image_url)
                        <div class="mb-4 rounded-4 overflow-hidden">
                            <img src="{{ $raffle->image_url }}"
                                 class="img-fluid w-100"
                                 style="max-height: 280px; object-fit: cover;"
                                 alt="{{ $raffle->title }}">
                        </div>
                    @endif

                    <div class="mb-3">
                        <h5 class="text-muted text-uppercase small mb-2">
                            <i class="fas fa-info-circle me-1"></i> Detalhes da Rifa
                        </h5>
                        <p class="mb-0">{!! nl2br(e($raffle->description)) !!}</p>
                    </div>

                    <hr>

                    <div class="row g-3 small">
                        <div class="col-sm-6">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Prêmio</span>
                            <span class="fw-bold">
                                <i class="fas fa-gift text-warning me-1"></i>
                                {{ $raffle->prize }}
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Valor do Bilhete</span>
                            <span class="fw-bold text-primary">
                                R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Data do Sorteio</span>
                            <span>
                                {{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Status</span>
                            @php
                                $statusLabel = [
                                    'ativa'    => 'Ativa',
                                    'pausada'  => 'Pausada',
                                    'encerrada'=> 'Encerrada',
                                ][$raffle->status] ?? ucfirst($raffle->status);

                                $statusColor = [
                                    'ativa'    => 'success',
                                    'pausada'  => 'warning',
                                    'encerrada'=> 'secondary',
                                ][$raffle->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="row g-3 small">
                        <div class="col-sm-4">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Total de Números</span>
                            <span class="fw-bold">{{ $raffle->total_tickets }}</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Vendidos</span>
                            <span class="fw-bold text-danger">{{ $ticketsSold }}</span>
                        </div>
                        <div class="col-sm-4">
                            <span class="text-muted text-uppercase d-block fw-semibold mb-1">Disponíveis</span>
                            <span class="fw-bold text-success">{{ $remaining }}</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SEUS NÚMEROS --}}
            @auth
                @if(!empty($userTickets))
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary"
                                     style="width: 40px; height: 40px;">
                                    <i class="fas fa-list-ol"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Seus Números</h5>
                                    <small class="text-muted">Esses são os números que você já comprou nesta rifa.</small>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                @foreach($userTickets as $ticket)
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        #{{ $ticket }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

        </div>

        {{-- COLUNA DIREITA – COMPRA --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-success-subtle text-success"
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Participar da Rifa</h5>
                            <small class="text-muted">
                                Escolha a quantidade de números que deseja comprar.
                            </small>
                        </div>
                    </div>

                    @if($remaining > 0 && $raffle->status === 'ativa')
                        @auth
                            <form action="{{ route('raffle.buy', $raffle) }}" method="POST" class="vstack gap-3">
                                @csrf

                                <div>
                                    <label for="quantity" class="form-label fw-semibold">
                                        Quantos números deseja?
                                    </label>
                                    <input
                                        type="number"
                                        name="quantity"
                                        id="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        min="1"
                                        max="{{ $remaining }}"
                                        value="{{ old('quantity', 1) }}"
                                        required
                                    >
                                    <small class="text-muted d-block mt-1">
                                        Restam <strong>{{ $remaining }}</strong> números disponíveis.
                                    </small>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="bg-light rounded-3 p-3 small">
                                    <div class="d-flex justify-content-between">
                                        <span>Valor por número</span>
                                        <strong>R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <span>Total estimado</span>
                                        <strong id="raffle-total">
                                            R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}
                                        </strong>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                    <i class="fas fa-paw me-1"></i>
                                    Comprar Números
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-lock me-1"></i>
                                Você precisa estar logado para comprar números.
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt me-1"></i> Fazer login
                            </a>
                        @endauth
                    @else
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Esta rifa está encerrada ou sem números disponíveis.
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('raffles') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-arrow-left me-1"></i> Voltar para todas as rifas
                </a>
            </div>
        </div>

    </div>
</div>

{{-- Script simples pra atualizar o total estimado (sem mudar nada no backend) --}}
@auth
    @if($remaining > 0 && $raffle->status === 'ativa')
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const qtyInput = document.getElementById('quantity');
                const totalEl  = document.getElementById('raffle-total');
                const price    = {{ $raffle->ticket_price }};

                if (qtyInput && totalEl) {
                    const updateTotal = () => {
                        const q = Math.max(1, parseInt(qtyInput.value || '1', 10));
                        const total = q * price;
                        totalEl.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
                    };
                    qtyInput.addEventListener('input', updateTotal);
                    updateTotal();
                }
            });
        </script>
        @endpush
    @endif
@endauth
@endsection
