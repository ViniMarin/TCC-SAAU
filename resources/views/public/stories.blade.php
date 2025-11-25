@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h1 class="mb-0">Histórias de Adoção</h1>
        @auth
            @if(auth()->user()->role === 'adotante')
            <a href="{{ route('stories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Cadastrar história
            </a>
            @endif
        @endauth
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        @forelse($stories as $story)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($story->photo_url)
                <img src="{{ $story->photo_url }}" class="card-img-top" alt="{{ $story->animal_name }}" style="height: 220px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $story->animal_name }}</h5>
                    <p class="card-text">{{ Str::limit($story->story, 150) }}</p>
                    <p class="card-text"><small>Por: {{ $story->adopter_name }}</small></p> 
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhuma história aprovada.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $stories->links() }}
    </div>
</div>
@endsection
