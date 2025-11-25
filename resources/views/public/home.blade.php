@extends('layouts.app')

@section('title', 'Início - SAAU')

{{-- 
    Deixamos o header-content vazio para manter a faixa azul limpa atrás do banner.
    A faixa azul do layout servirá de fundo para a parte superior do banner.
--}}
@section('header-content')
@endsection

@section('banner')
<div class="container home-banner-wrapper">
    <div class="banner-frame">
        
        {{-- IMAGEM DO BANNER --}}
        {{-- Certifique-se de ter uma imagem chamada 'banner-novo.jpg' em public/images --}}
        <img src="{{ asset('images/banner-novo.jpg') }}" 
             alt="Banner SAAU" 
             class="img-fluid w-100 h-100"
             style="object-fit: cover; min-height: 450px; background-color: #e0e0e0;"
             onerror="this.style.display='none'; document.getElementById('placeholder-banner').style.display='flex';">

        {{-- PLACEHOLDER (Aparece se a imagem não carregar) --}}
        <div id="placeholder-banner" style="display: none; height: 450px; width: 100%; background-color: #f8f9fa; align-items: center; justify-content: center; text-align: center; color: #6c757d; flex-direction: column;">
            <i class="fas fa-image fa-4x mb-3 text-primary opacity-25"></i>
            <h3 class="fw-bold text-primary">Espaço para seu Banner</h3>
            <p class="text-muted">Recomendado: 1200x450px</p>
        
        </div>

    </div>
</div>
@endsection

@section('content')
<div class="container my-5 pt-3">
    
    <!-- Cards de Estatísticas -->
    <div class="row text-center mb-5 g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-paw fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['animals'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-home fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['adopted'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-calendar-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['events'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-ticket-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['raffles'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Rifas Ativas</p>
            </div>
        </div>
    </div>

    <!-- Título Histórias -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-book-open text-warning me-2"></i> Histórias de Finais Felizes
        </h2>
        <p class="text-muted">Veja como a adoção transformou a vida desses animais</p>
    </div>

    <!-- Grid de Histórias -->
    <div class="row g-4">
        @forelse($stories as $story)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;">
                @if($story->photo_url)
                <div style="height: 250px; overflow: hidden;">
                    <img src="{{ $story->photo_url }}" class="card-img-top w-100 h-100" alt="{{ $story->animal_name }}" style="object-fit: cover; transition: transform 0.5s;">
                </div>
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-heart fa-4x text-muted opacity-25"></i>
                </div>
                @endif
                
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold text-dark">{{ $story->animal_name }}</h5>
                    <p class="text-primary small mb-3 fw-bold"><i class="fas fa-user-circle me-1"></i> Adotado por {{ $story->adopter_name }}</p>
                    
                    <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ \Illuminate\Support\Str::limit($story->story, 120) }}
                    </p>
                    
                    <a href="{{ route('stories.index') }}" class="btn btn-outline-primary rounded-pill mt-3 fw-bold stretched-link">
                        Ler história completa
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="opacity-50 mb-3">
                <i class="fas fa-folder-open fa-4x text-muted"></i>
            </div>
            <p class="text-muted fs-5">Ainda não há histórias cadastradas.</p>
        </div>
        @endforelse
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('stories.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm text-white">
            <i class="fas fa-plus me-2"></i> Ver todas as histórias
        </a>
    </div>
</div>

<style>
    /* ESTILOS DO BANNER FLUTUANTE */
    .home-banner-wrapper {
        /* A margem negativa puxa o banner para cima da faixa azul */
        /* Z-index 30 garante que fique na frente da faixa azul (que tem z-index 10) */
        margin-top: -150px; 
        position: relative;
        z-index: 30; 
        padding: 0 15px;
    }

    .banner-frame {
        border-radius: 20px;
        overflow: hidden;
        background-color: #ffffff;
        /* Sombra forte para dar o efeito de flutuação */
        box-shadow: 0 20px 40px rgba(0, 86, 179, 0.15); 
        min-height: 400px;
        /* Moldura branca opcional */
        border: 8px solid #ffffff; 
    }

    /* Efeitos de Hover dos Cards */
    .ls-1 { letter-spacing: 1px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,50,100,0.1) !important; }
    .card:hover .card-img-top { transform: scale(1.1); }
</style>
@endsection