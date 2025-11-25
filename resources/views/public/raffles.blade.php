@extends('layouts.app')

@section('title', 'Rifas Solidárias - SAAU')

@section('header-content')
    <h1 class="page-header-title">RIFAS SOLIDÁRIAS</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-4">
        @forelse($raffles as $raffle)
        <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
            <div class="card h-100 w-100 border-0 shadow-sm card-custom hover-lift">
                
                {{-- FOTO DA RIFA --}}
                <div class="position-relative overflow-hidden img-container">
                    @if($raffle->image_url)
                        <img src="{{ $raffle->image_url }}" class="card-img-top" alt="{{ $raffle->title }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-ticket-alt fa-3x text-primary opacity-25"></i>
                        </div>
                    @endif

                    {{-- Badge de Preço --}}
                    <div class="position-absolute bottom-0 end-0 m-3">
                        <span class="badge bg-warning text-dark shadow fw-bold fs-6 px-3 py-2 rounded-pill">
                            R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- CORPO DO CARD --}}
                <div class="card-body p-4 d-flex flex-column text-center">
                    <h4 class="card-title fw-bold text-primary mb-2">{{ $raffle->title }}</h4>
                    <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($raffle->description, 80) }}</p>

                    <div class="bg-light rounded-3 p-3 mb-4 border border-light-subtle">
                        <small class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">Prêmio</small>
                        <div class="fw-bold text-dark">
                            <i class="fas fa-gift text-warning me-2"></i> {{ $raffle->prize }}
                        </div>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('raffle.show', $raffle) }}"
                           class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                            PARTICIPAR
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-ticket-alt fa-4x"></i>
                </div>
                <h4 class="text-dark fw-bold">Nenhuma rifa ativa</h4>
                <p class="text-muted">Aguarde nossas próximas campanhas solidárias.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card-custom {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        overflow: hidden;
    }
    .img-container {
        height: 240px;
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
</style>
@endsection
