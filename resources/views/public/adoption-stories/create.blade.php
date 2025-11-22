@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="mb-4 text-center">Compartilhe sua História</h1>

                    @if(session('error'))
                        <div class="alert alert-warning">{{ session('error') }}</div>
                    @endif

                    <p class="text-muted">Conte-nos como foi a jornada de adoção do seu novo melhor amigo. Sua história
                        só será exibida após aprovação da nossa equipe.</p>

                    <form action="{{ route('adoption-stories.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nome do adotante</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="animal_name" class="form-label">Qual animal você adotou?</label>
                            <select name="animal_name" id="animal_name" class="form-select @error('animal_name') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                @foreach($adoptedAnimals as $animal)
                                    <option value="{{ $animal['animal_name'] }}" {{ old('animal_name') === $animal['animal_name'] ? 'selected' : '' }}>
                                        {{ $animal['animal_name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('animal_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="story" class="form-label">Conte sua história</label>
                            <textarea name="story" id="story" rows="6" class="form-control @error('story') is-invalid @enderror" placeholder="Como foi o processo de adoção e adaptação?" required>{{ old('story') }}</textarea>
                            @error('story')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto (opcional)</label>
                            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Tamanho máximo 5MB.</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar para aprovação</button>
                            <a href="{{ route('stories.index') }}" class="btn btn-outline-secondary">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
