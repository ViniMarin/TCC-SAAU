@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Eventos</h1>
    <div class="row">
        @forelse($events as $event)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($event->image_url)
                <img src="{{ $event->image_url }}" class="card-img-top" alt="Imagem do evento {{ $event->title }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-calendar fa-3x text-muted"></i>
                </div>
                @endif
                <div class="card-body">
                    <h5>{{ $event->title }}</h5>
                    <p>{{ $event->description }}</p>
                    <p><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-outline-primary w-100">Saiba Mais</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhum evento ativo.</p>
        @endforelse
    </div>
</div>
@endsection
