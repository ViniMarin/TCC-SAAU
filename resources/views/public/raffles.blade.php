@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Rifas</h1>

    @if($eventsWithImages->count())
    <section class="mb-5">
        <h2 class="h4 mb-3 text-center">Eventos com Imagens</h2>
        <div class="row">
            @foreach($eventsWithImages as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5>{{ $event->title }}</h5>
                        <p class="mb-2">{{ $event->description }}</p>
                        <p class="mb-1"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <div class="row">
        @forelse($raffles as $raffle)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($raffle->image_url)
                <img src="{{ $raffle->image_url }}" class="card-img-top" alt="{{ $raffle->title }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5>{{ $raffle->title }}</h5>
                    <p>{{ $raffle->description }}</p>
                    <p><strong>Prêmio:</strong> {{ $raffle->prize }}</p>
                    <p><strong>Valor:</strong> R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('raffle.show', $raffle) }}" class="btn btn-sm btn-primary w-100">Comprar Bilhetes</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhuma rifa ativa.</p>
        @endforelse
    </div>
</div>
@endsection
