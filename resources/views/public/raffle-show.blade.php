@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1 class="mb-4">{{ $raffle->title }}</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Detalhes da Rifa</h5>
                    <p class="card-text">{!! nl2br(e($raffle->description)) !!}</p>
                    <hr>
                    <p><strong>Prêmio:</strong> {{ $raffle->prize }}</p>
                    <p><strong>Valor do Bilhete:</strong> R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</p>
                    <p><strong>Data do Sorteio:</strong> {{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}</p>
                    <p><strong>Total de Bilhetes:</strong> {{ $raffle->total_tickets }}</p>
                    <p><strong>Bilhetes Vendidos:</strong> {{ $ticketsSold }}</p>
                    <p><strong>Bilhetes Restantes:</strong> {{ $raffle->total_tickets - $ticketsSold }}</p>
                </div>
            </div>

            @auth
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-ticket-alt"></i> Comprar Bilhetes</h5>
                    @if($raffle->total_tickets - $ticketsSold > 0)
                        <form action="{{ route('raffle.buy', $raffle) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantos bilhetes deseja comprar?</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $raffle->total_tickets - $ticketsSold }}" required>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-shopping-cart"></i> Comprar Bilhetes (R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }} cada)
                            </button>
                        </form>
                    @else
                        <p class="text-danger">Todos os bilhetes foram vendidos!</p>
                    @endif
                </div>
            </div>

            @if(count($userTickets) > 0)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-list-ol"></i> Seus Bilhetes</h5>
                    <p>Você comprou os seguintes números:</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($userTickets as $ticket)
                            <span class="badge bg-primary">{{ $ticket }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @else
            <div class="alert alert-info text-center">
                <i class="fas fa-lock"></i> Você precisa estar logado para comprar bilhetes. <a href="{{ route('login') }}">Faça login aqui</a>.
            </div>
            @endauth

            <div class="mt-5">
                <a href="{{ route('raffles') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar para Rifas</a>
            </div>
        </div>
    </div>
</div>
@endsection
