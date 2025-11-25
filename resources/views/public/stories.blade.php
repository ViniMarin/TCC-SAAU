@extends('layouts.app')

@section('title', 'Histórias de Adoção - SAAU')

@section('header-content')
    <h1 class="page-header-title">HISTÓRIAS DE ADOÇÃO</h1>
@endsection

@section('content')
<div class="container my-5">

    {{-- Botão de Ação --}}
    @auth
        @if(auth()->user()->role === 'adotante')
        <div class="row mb-5 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="bg-white p-4 rounded-4 shadow-sm border border-light-subtle">
                    <h5 class="fw-bold text-primary mb-2">Você adotou um animalzinho da SAAU?</h5>
                    <p class="text-muted mb-3 small">Compartilhe sua alegria e inspire outras pessoas a adotar!</p>
                    <a href="{{ route('stories.create') }}" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                        <i class="fas fa-pen-fancy me-2"></i> ESCREVER MINHA HISTÓRIA
                    </a>
                </div>
            </div>
        </div>
        @endif
    @endauth

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        @forelse($stories as $story)
        <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
            
            <div class="card h-100 w-100 border-0 shadow-sm card-custom hover-lift">
                
                {{-- FOTO --}}
                <div class="position-relative overflow-hidden img-container">
                    @if($story->photo_url)
                        <img src="{{ $story->photo_url }}" class="card-img-top" alt="{{ $story->animal_name }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-heart fa-3x text-danger opacity-25"></i>
                        </div>
                    @endif
                    
                    {{-- Overlay com Nome do Adotante --}}
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                <i class="fas fa-user small"></i>
                            </div>
                            <small class="fw-bold text-shadow">Adotado por {{ Str::limit($story->adopter_name, 20) }}</small>
                        </div>
                    </div>
                </div>

                {{-- CORPO --}}
                <div class="card-body p-4 d-flex flex-column">
                    
                    <h4 class="card-title fw-bold text-primary mb-3">{{ $story->animal_name }}</h4>
                    
                    <div class="position-relative ps-3 mb-4">
                        {{-- Linha vertical decorativa --}}
                        <div class="position-absolute start-0 top-0 bottom-0 bg-warning rounded" style="width: 4px;"></div>
                        <p class="card-text text-muted small fst-italic mb-0" style="line-height: 1.6;">
                            "{{ Str::limit($story->story, 120) }}"
                        </p>
                    </div>

                    <div class="mt-auto text-end">
                        <a href="#" class="btn btn-link text-decoration-none fw-bold text-primary p-0 stretched-link">
                            LER COMPLETA <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-book-open fa-4x"></i>
                </div>
                <h4 class="text-dark fw-bold">Nenhuma história publicada</h4>
                <p class="text-muted">Seja o primeiro a compartilhar sua experiência!</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $stories->links() }}
    </div>
</div>

<style>
    /* CSS Padrão */
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
    /* Gradiente para leitura de texto sobre imagem */
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    .text-shadow { text-shadow: 1px 1px 2px rgba(0,0,0,0.8); }
</style>
@endsection