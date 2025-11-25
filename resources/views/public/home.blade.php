@extends('layouts.app')

@section('title', 'Início - SAAU')

{{-- Deixamos o header-content vazio para usar só a faixa azul do layout --}}
@section('header-content')
@endsection

@section('banner')
<div class="container home-banner-wrapper">
    <div class="banner-frame">
        {{-- IMAGEM DO BANNER --}}
        <img src="{{ asset('images/banner-novo.jpg') }}"
             alt="Banner SAAU"
             class="img-fluid w-100 h-100"
             style="object-fit: cover; min-height: 450px; background-color: #e0e0e0;"
             onerror="this.style.display='none'; document.getElementById('placeholder-banner').style.display='flex';">

        {{-- PLACEHOLDER (aparece se a imagem não carregar) --}}
        <div id="placeholder-banner" style="display:none; height:450px; width:100%; background-color:#f8f9fa; align-items:center; justify-content:center; text-align:center; color:#6c757d; flex-direction:column;">
            <i class="fas fa-image fa-4x mb-3 text-primary opacity-25"></i>
            <h3 class="fw-bold text-primary">Espaço para seu Banner</h3>
            <p class="text-muted">Recomendado: 1200x450px</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container my-5 pt-3">

    {{-- CARDS DE ESTATÍSTICAS --}}
    <div class="row text-center mb-5 g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius:20px;">
                <div class="mb-3">
                    <i class="fas fa-paw fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['animals'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius:20px;">
                <div class="mb-3">
                    <i class="fas fa-home fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['adopted'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius:20px;">
                <div class="mb-3">
                    <i class="fas fa-calendar-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['events'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius:20px;">
                <div class="mb-3">
                    <i class="fas fa-ticket-alt fa-3x text-primary opacity-75"></i>
                </div>
                <h2 class="text-dark fw-bold display-5">{{ $stats['raffles'] ?? 0 }}</h2>
                <p class="text-muted fw-bold text-uppercase small ls-1">Rifas Ativas</p>
            </div>
        </div>
    </div>

    {{-- TÍTULO HISTÓRIAS --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-book-open text-warning me-2"></i> Histórias de Finais Felizes
        </h2>
        <p class="text-muted">Veja como a adoção transformou a vida desses animais</p>
    </div>

    {{-- GRID DE HISTÓRIAS (MESMO ESTILO DA PÁGINA /stories) --}}
    <div class="row g-4">
        @forelse($stories as $story)
            <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
                <div class="card h-100 w-100 border-0 shadow-sm card-custom hover-lift">

                    {{-- FOTO --}}
                    <div class="position-relative overflow-hidden img-container">
                        @php
                            $photoUrl = null;
                            if ($story->photo_url) {
                                $photoPath = $story->photo_url;

                                // se já for http/https, usa direto
                                if (preg_match('#^https?://#', $photoPath)) {
                                    $photoUrl = $photoPath;
                                }
                                // se começar com /storage/ (caso antigo com Storage::url)
                                elseif (substr($photoPath, 0, 9) === '/storage/') {
                                    $photoUrl = asset(ltrim($photoPath, '/'));
                                }
                                // caso novo: só "stories/arquivo.jpg"
                                else {
                                    $photoUrl = asset('storage/'.$photoPath);
                                }
                            }
                        @endphp

                        @if($photoUrl)
                            <img src="{{ $photoUrl }}" class="card-img-top" alt="{{ $story->animal_name }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-heart fa-3x text-danger opacity-25"></i>
                            </div>
                        @endif

                        {{-- Overlay com Nome do Adotante --}}
                        <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-2"
                                     style="width:30px; height:30px;">
                                    <i class="fas fa-user small"></i>
                                </div>
                                <small class="fw-bold text-shadow">
                                    Adotado por {{ \Illuminate\Support\Str::limit($story->adopter_name, 20) }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- CORPO --}}
                    <div class="card-body p-4 d-flex flex-column">
                        <h4 class="card-title fw-bold text-primary mb-3">{{ $story->animal_name }}</h4>

                        <div class="position-relative ps-3 mb-4">
                            {{-- Linha vertical decorativa --}}
                            <div class="position-absolute start-0 top-0 bottom-0 bg-warning rounded" style="width:4px;"></div>
                            <p class="card-text text-muted small fst-italic mb-0" style="line-height:1.6;">
                                "{{ \Illuminate\Support\Str::limit($story->story, 120) }}"
                            </p>
                        </div>

                        <div class="mt-auto text-end">
                            <a href="{{ route('stories.show', $story) }}"
                               class="btn btn-link text-decoration-none fw-bold text-primary p-0 stretched-link">
                                Ler história completa <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
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
        margin-top: -150px;
        position: relative;
        z-index: 30;
        padding: 0 15px;
    }
    .banner-frame {
        border-radius: 20px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 86, 179, 0.15);
        min-height: 400px;
        border: 8px solid #ffffff;
    }

    /* CARDS DE HISTÓRIAS (mesmo padrão da página /stories) */
    .card-custom {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        overflow: hidden;
    }
    .img-container {
        height: 260px;
        background-color: #f8f9fa;
    }
    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15) !important;
    }
    .hover-lift:hover .card-img-top {
        transform: scale(1.05);
    }
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    .text-shadow {
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    }
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection
