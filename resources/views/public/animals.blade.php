@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Animais Disponíveis</h1>

    {{-- =========================
         FILTRO DE ADOÇÃO
       ========================== --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('animals') }}">
                <div class="row g-3">

                    {{-- Espécie --}}
                    <div class="col-md-3">
                        <label class="form-label">Espécie</label>
                        <select name="species" class="form-control">
                            <option value="">Todas</option>
                            <option value="cão"  {{ request('species') == 'cão' ? 'selected' : '' }}>Cão</option>
                            <option value="gato" {{ request('species') == 'gato' ? 'selected' : '' }}>Gato</option>
                        </select>
                    </div>

                    {{-- Sexo --}}
                    <div class="col-md-3">
                        <label class="form-label">Sexo</label>
                        <select name="gender" class="form-control">
                            <option value="">Todos</option>
                            <option value="macho" {{ request('gender') == 'macho' ? 'selected' : '' }}>Macho</option>
                            <option value="fêmea" {{ request('gender') == 'fêmea' ? 'selected' : '' }}>Fêmea</option>
                        </select>
                    </div>

                    {{-- Idade (filhote / adulto / idoso) --}}
                    <div class="col-md-3">
                        <label class="form-label">Idade</label>
                        <select name="age" class="form-control">
                            <option value="">Todas</option>
                            <option value="filhote" {{ request('age') == 'filhote' ? 'selected' : '' }}>Filhote</option>
                            <option value="adulto"  {{ request('age') == 'adulto' ? 'selected' : '' }}>Adulto</option>
                            <option value="idoso"   {{ request('age') == 'idoso' ? 'selected' : '' }}>Idoso</option>
                        </select>
                    </div>

                    {{-- Porte --}}
                    <div class="col-md-3">
                        <label class="form-label">Porte</label>
                        <select name="size" class="form-control">
                            <option value="">Todos</option>
                            <option value="pequeno" {{ request('size') == 'pequeno' ? 'selected' : '' }}>Pequeno</option>
                            <option value="médio"   {{ request('size') == 'médio' ? 'selected' : '' }}>Médio</option>
                            <option value="grande"  {{ request('size') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('animals') }}" class="btn btn-outline-secondary">
                            Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- =========================
         LISTAGEM DOS ANIMAIS
       ========================== --}}
    <div class="row">
        @forelse($animals as $animal)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($animal->photo_url)
                <img src="{{ $animal->photo_url }}" class="card-img-top" alt="{{ $animal->name }}" style="height: 250px; object-fit: cover;">
                @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-paw fa-4x text-white"></i>
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $animal->name }}</h5>
                    <p class="card-text">
                        <i class="fas fa-paw"></i> {{ ucfirst($animal->species) }} | 
                        <i class="fas fa-{{ $animal->gender == 'macho' ? 'mars' : 'venus' }}"></i> {{ ucfirst($animal->gender) }}<br>

                        @if($animal->age)
                        <i class="fas fa-calendar"></i> {{ ucfirst($animal->age) }}<br>
                        @endif

                        @if($animal->size)
                        <i class="fas fa-ruler"></i> Porte {{ ucfirst($animal->size) }}
                        @endif
                    </p>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($animal->description, 100) }}</p>
                    <a href="{{ route('animal.show', $animal->id) }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-heart"></i> Ver Detalhes e Adotar
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Nenhum animal disponível.</p>
        @endforelse
    </div>

    {{-- Mantém os filtros na paginação --}}
    {{ $animals->withQueryString()->links() }}
</div>
@endsection
