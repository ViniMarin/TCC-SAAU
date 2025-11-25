@extends('layouts.app')

@section('title', 'História de ' . $story->animal_name . ' - SAAU')

@section('header-content')
    <h1 class="page-header-title">HISTÓRIA DE {{ strtoupper($story->animal_name) }}</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            @php
                $photoUrl = $story->photo_url
                    ? (\Illuminate\Support\Str::startsWith($story->photo_url, ['http://', 'https://', '/'])
                        ? $story->photo_url
                        : \Illuminate\Support\Facades\Storage::url($story->photo_url))
                    : null;
            @endphp

            {{-- CARD ÚNICO: IMAGEM + HISTÓRIA --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                {{-- Imagem com overlay do adotante --}}
                <div class="position-relative story-image-wrapper">
                    @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="{{ $story->animal_name }}" class="w-100">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 320px;">
                            <i class="fas fa-heart fa-4x text-danger opacity-25"></i>
                        </div>
                    @endif

                    <div class="position-absolute bottom-0 start-0 w-100 px-4 py-3 bg-gradient-dark text-white">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-2"
                                 style="width: 34px; height: 34px;">
                                <i class="fas fa-user small"></i>
                            </div>
                            <span class="fw-semibold text-shadow small">
                                Adotado por {{ $story->adopter_name }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Texto da história --}}
                <div class="card-body p-4 p-md-5">
                    <h2 class="h4 fw-bold text-primary mb-2">{{ $story->animal_name }}</h2>
                    <p class="text-muted small mb-4">
                        História compartilhada em {{ $story->created_at->format('d/m/Y') }}
                    </p>

                    <p class="mb-0" style="line-height: 1.8; white-space: pre-line;">
                        {{ $story->story }}
                    </p>
                </div>
            </div>

            {{-- BOTÃO ÚNICO DE VOLTAR (PADRÃO DOS EVENTOS) --}}
            <div class="mt-4">
                <a href="{{ route('stories.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar para histórias
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .story-image-wrapper img {
        max-height: 420px;
        object-fit: cover;
        display: block;
    }
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    .text-shadow {
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    }
</style>
@endsection
