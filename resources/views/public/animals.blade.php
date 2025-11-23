@extends('layouts.app')

@section('content')
<div class="container-fluid my-5 px-4 px-lg-5">
    <h1 class="text-center mb-4">Animais Disponíveis</h1>

    <div class="row g-4">
        {{-- =========================
             FILTRO DE ADOÇÃO
           ========================== --}}
        <div class="col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Filtrar</h5>
                    <form method="GET" action="{{ route('animals') }}">
                        <div class="mb-3">
                            <label class="form-label">Espécie</label>
                            <select name="species" class="form-control">
                                <option value="">Todas</option>
                                <option value="cão"  {{ request('species') == 'cão' ? 'selected' : '' }}>Cão</option>
                                <option value="gato" {{ request('species') == 'gato' ? 'selected' : '' }}>Gato</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select name="gender" class="form-control">
                                <option value="">Todos</option>
                                <option value="macho" {{ request('gender') == 'macho' ? 'selected' : '' }}>Macho</option>
                                <option value="fêmea" {{ request('gender') == 'fêmea' ? 'selected' : '' }}>Fêmea</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Idade</label>
                            <select name="age" class="form-control">
                                <option value="">Todas</option>
                                <option value="filhote" {{ request('age') == 'filhote' ? 'selected' : '' }}>Filhote</option>
                                <option value="adulto"  {{ request('age') == 'adulto' ? 'selected' : '' }}>Adulto</option>
                                <option value="idoso"   {{ request('age') == 'idoso' ? 'selected' : '' }}>Idoso</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Porte</label>
                            <select name="size" class="form-control">
                                <option value="">Todos</option>
                                <option value="pequeno" {{ request('size') == 'pequeno' ? 'selected' : '' }}>Pequeno</option>
                                <option value="médio"   {{ request('size') == 'médio' ? 'selected' : '' }}>Médio</option>
                                <option value="grande"  {{ request('size') == 'grande' ? 'selected' : '' }}>Grande</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                            <a href="{{ route('animals') }}" class="btn btn-outline-secondary">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- =========================
             LISTAGEM DOS ANIMAIS
           ========================== --}}
        <div class="col-lg-9">
            <div class="row">
                @forelse($animals as $animal)
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100 position-relative">
                        @if($animal->special_needs)
                        <span class="badge bg-warning text-dark position-absolute" style="top: 10px; right: 10px;">Necessidades Especiais</span>
                        @endif

                        @if($animal->photo_url)
                        <img src="{{ $animal->photo_url }}" class="card-img-top" alt="{{ $animal->name }}" style="height: 250px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="fas fa-paw fa-4x text-white"></i>
                        </div>
                        @endif

                        <div class="card-body">
                            @php
                                $genderIcon = $animal->gender === 'macho' ? 'mars' : 'venus';
                                $genderLabel = $animal->gender === 'macho' ? 'Macho' : 'Fêmea';
                            @endphp
                            <h5 class="card-title">{{ $animal->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-paw"></i> {{ ucfirst($animal->species) }} |
                                <i class="fas fa-{{ $genderIcon }}"></i> {{ $genderLabel }}<br>

                                @if($animal->age)
                                <i class="fas fa-calendar"></i> {{ ucfirst($animal->age) }}<br>
                                @endif

                                @if($animal->size)
                                <i class="fas fa-ruler"></i> Porte {{ ucfirst($animal->size) }}
                                @endif
                            </p>
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
    </div>
</div>
@endsection
