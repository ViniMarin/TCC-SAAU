@extends('layouts.app')

@section('title', 'Início - SAAU')

{{-- SEÇÃO DO BANNER (COM SOBREPOSIÇÃO) --}}
@section('banner')
<div class="container home-banner-wrapper">
    <div class="banner-frame">
        
        {{-- COLOQUE A SUA IMAGEM AQUI --}}
        {{-- Substitua 'banner-novo.jpg' pelo nome do seu arquivo na pasta public/images --}}
        <img src="{{ asset('images/banner-novo.jpg') }}" 
             alt="Banner SAAU" 
             class="img-fluid w-100 h-100"
             style="object-fit: cover; min-height: 400px; background-color: #e0e0e0;"
             onerror="this.style.display='none'; document.getElementById('placeholder-banner').style.display='flex';">

        {{-- Placeholder (Aparece só se não tiver imagem) --}}
        <div id="placeholder-banner" style="display: none; height: 450px; width: 100%; background-color: #e9ecef; align-items: center; justify-content: center; text-align: center; color: #6c757d;">
            <div>
                <i class="fas fa-image fa-4x mb-3 opacity-50"></i>
                <h4>Coloque seu Banner Aqui</h4>
                <p class="small">Tamanho sugerido: 1200x450px</p>
            </div>
        </div>

    </div>
</div>
@endsection

@section('content')
<div class="container my-5">
    
    <div class="row text-center mb-5 g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-paw fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['animals'] }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-home fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['adopted'] }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-calendar-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['events'] }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-ticket-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['raffles'] }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Rifas Ativas</p>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: var(--saau-dark);">
            <i class="fas fa-book-open text-warning me-2"></i> Histórias de Finais Felizes
        </h2>
        <p class="text-muted">Veja como a adoção transformou a vida desses animais</p>
    </div>

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
    /* ESTILOS ESPECÍFICOS PARA O BANNER DE SOBREPOSIÇÃO */
    .home-banner-wrapper {
        margin-top: -120px; /* Puxa o banner 120px para cima da faixa azul */
        position: relative;
        z-index: 30; /* Garante que fique na frente da faixa azul */
        padding: 0 20px; /* Margem lateral para não colar na borda da tela em mobile */
    }

    .banner-frame {
        border-radius: 20px;
        overflow: hidden;
        background-color: #ffffff;
        /* Sombra forte para dar destaque e efeito "flutuante" */
        box-shadow: 0 20px 40px rgba(0,0,0,0.2); 
        min-height: 400px;
    }

    /* Ajustes gerais */
    .ls-1 { letter-spacing: 1px; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,50,100,0.1) !important; }
    .card:hover .card-img-top { transform: scale(1.1); }
</style>
@endsection