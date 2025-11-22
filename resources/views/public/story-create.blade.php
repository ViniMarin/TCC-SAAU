@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="mb-1">Compartilhar História de Adoção</h1>
                    <p class="text-muted mb-0">Conte como foi a chegada do seu novo amigo e inspire outras adoções!</p>
                </div>
                <a href="{{ route('stories.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('stories.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Adotante</label>
                            <input type="text" class="form-control" value="{{ $adopterName }}" disabled>
                            <div class="form-text">Usaremos o nome da sua conta para a publicação.</div>
                        </div>

                        <div class="mb-3">
                            <label for="animal_name" class="form-label">Nome do animal<span class="text-danger">*</span></label>
                            <input type="text" id="animal_name" name="animal_name" class="form-control @error('animal_name') is-invalid @enderror" value="{{ old('animal_name') }}" required>
                            @error('animal_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="story" class="form-label">História<span class="text-danger">*</span></label>
                            <textarea id="story" name="story" rows="6" class="form-control @error('story') is-invalid @enderror" placeholder="Conte como foi o processo de adoção, adaptação e momentos especiais" required>{{ old('story') }}</textarea>
                            @error('story')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_url" class="form-label">URL da foto (opcional)</label>
                            <input type="url" id="photo_url" name="photo_url" class="form-control @error('photo_url') is-invalid @enderror" value="{{ old('photo_url') }}" placeholder="https://exemplo.com/foto.jpg">
                            @error('photo_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">A imagem será exibida junto com a sua história após aprovação.</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Enviar história
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
