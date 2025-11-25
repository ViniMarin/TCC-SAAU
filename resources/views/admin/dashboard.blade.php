@extends('layouts.admin')

@section('title', 'Dashboard - SAAU')
@section('page-title', 'Visão Geral do Sistema')

@section('content')
<div class="container-fluid">
    
    <!-- Cards de Estatísticas -->
    <div class="row g-4 mb-5">
        
        <!-- Card Animais -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 stat-card" style="border-left: 5px solid var(--saau-blue-primary) !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Animais</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalAnimals ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-blue-soft">
                            <i class="fas fa-dog"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small">
                        <span class="text-success fw-bold me-2"><i class="fas fa-arrow-up"></i> Novos</span>
                        <span class="text-muted">este mês</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Adoções -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 stat-card" style="border-left: 5px solid var(--saau-yellow) !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Adoções</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalAdoptions ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-yellow-soft">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small">
                        <span class="text-success fw-bold me-2"><i class="fas fa-check"></i> Realizadas</span>
                        <span class="text-muted">total</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Usuários -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 stat-card" style="border-left: 5px solid var(--saau-blue-dark) !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Usuários</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalUsers ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-blue-soft" style="color: var(--saau-blue-dark); background-color: rgba(0, 61, 128, 0.1);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small">
                        <span class="text-primary fw-bold me-2">Cadastrados</span>
                        <span class="text-muted">no sistema</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Rifas -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 stat-card" style="border-left: 5px solid #28a745 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Rifas Ativas</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $activeRaffles ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-green-soft">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center small">
                        <span class="text-success fw-bold me-2">Em andamento</span>
                        <span class="text-muted">agora</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Ações Rápidas e Gráficos (Exemplo) -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-primary mb-0">Últimos Pedidos de Adoção</h5>
                    <a href="{{ route('admin.adoption-requests.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Ver Todos</a>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th class="border-0 rounded-start">Solicitante</th>
                                    <th class="border-0">Animal</th>
                                    <th class="border-0">Data</th>
                                    <th class="border-0 rounded-end text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Exemplo estático, substituir por @foreach real --}}
                                @forelse($recentRequests ?? [] as $request)
                                <tr>
                                    <td class="fw-bold text-dark">{{ $request->user->name ?? 'Anônimo' }}</td>
                                    <td class="text-primary">{{ $request->animal->name ?? 'Animal' }}</td>
                                    <td class="text-muted small">{{ $request->created_at->format('d/m/Y') }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-warning text-dark rounded-pill px-3">Pendente</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="far fa-folder-open fa-2x mb-2 d-block opacity-25"></i>
                                        Nenhum pedido recente.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-0">Acesso Rápido</h5>
                </div>
                <div class="card-body px-4">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.animals.create') }}" class="btn btn-outline-primary text-start p-3 rounded-3 d-flex align-items-center transition-hover">
                            <div class="bg-blue-soft rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold">Novo Animal</span>
                                <small class="text-muted">Cadastrar para adoção</small>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.events.create') }}" class="btn btn-outline-secondary text-start p-3 rounded-3 d-flex align-items-center transition-hover border-0 bg-light">
                            <div class="bg-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center text-secondary shadow-sm" style="width: 40px; height: 40px;">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-dark">Novo Evento</span>
                                <small class="text-muted">Divulgar ação</small>
                            </div>
                        </a>

                        <a href="{{ route('admin.raffles.create') }}" class="btn btn-outline-secondary text-start p-3 rounded-3 d-flex align-items-center transition-hover border-0 bg-light">
                            <div class="bg-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center text-warning shadow-sm" style="width: 40px; height: 40px;">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-dark">Nova Rifa</span>
                                <small class="text-muted">Criar campanha</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .transition-hover {
        transition: all 0.2s ease;
    }
    .transition-hover:hover {
        transform: translateX(5px);
        background-color: var(--saau-light);
        border-color: var(--saau-blue-primary);
    }
</style>
@endsection