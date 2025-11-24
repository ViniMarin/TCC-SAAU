@extends('layouts.app')

@section('content')
<div class="hero">
    <div class="container">
        <h1 class="display-3"><i class="fas fa-heart"></i> Adote um Amigo</h1>
        <p class="lead">Dê uma segunda chance para um animal que precisa de amor e carinho</p>
        <a href="{{ route('animals') }}" class="btn btn-light btn-lg mt-3">Ver Animais Disponíveis</a>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-primary">{{ $stats['animals'] }}</h2>
                <p>Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-success">{{ $stats['adopted'] }}</h2>
                <p>Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-info">{{ $stats['events'] }}</h2>
                <p>Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-warning">{{ $stats['raffles'] }}</h2>
                <p>Rifas Ativas</p>
            </div>
        </div>
    </div>

    <h2 class="text-center mb-4">Histórias de Adoções Realizadas</h2>
    <div class="row">
        @forelse($stories as $story)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($story->photo_url)
                <img src="{{ $story->photo_url }}" class="card-img-top" alt="{{ $story->animal_name }}" style="height: 250px; object-fit: cover;">
                @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-heart fa-4x text-white"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $story->animal_name }}</h5>
                    <p class="text-muted mb-2"><i class="fas fa-user"></i> {{ $story->adopter_name }}</p>
                    <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($story->story, 140) }}</p>
                    <a href="{{ route('stories.index') }}" class="btn btn-primary w-100 mt-auto">
                        <i class="fas fa-book-open"></i> Ler mais histórias
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>Ainda não há histórias aprovadas.</p>
        </div>
        @endforelse
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('stories.index') }}" class="btn btn-outline-primary">Ver todas as histórias</a>
    </div>
</div>
@endsection
