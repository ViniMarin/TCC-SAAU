@extends('layouts.admin')

@section('title', 'Relatórios - Painel Admin')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1 class="page-title mb-1">Relatórios</h1>
        <p class="text-muted mb-0">Exporte informações dos módulos do painel em PDF com filtros de data e tipo.</p>
    </div>
</div>

<div class="content-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h2 class="card-title mb-0"><i class="fas fa-file-export me-2"></i>Gerar Relatório</h2>
    </div>

    <form action="{{ route('admin.reports.export') }}" method="GET" class="row g-3" target="_blank">
        <div class="col-md-6">
            <label for="type" class="form-label">Tipo de relatório</label>
            <select name="type" id="type" class="form-select" required>
                <option value="all">Completo (todos os módulos)</option>
                <option value="animals">Animais</option>
                <option value="vaccines">Vacinas</option>
                <option value="raffles">Rifas</option>
                <option value="events">Eventos</option>
                <option value="donations">Doações</option>
            </select>
            <small class="text-muted">Selecione "Completo" para incluir Animais, Vacinas, Rifas, Eventos e Doações.</small>
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Data inicial</label>
            <input type="date" name="start_date" id="start_date" class="form-control" />
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Data final</label>
            <input type="date" name="end_date" id="end_date" class="form-control" />
        </div>

        <div class="col-12 d-flex align-items-center justify-content-end gap-2">
            <button type="reset" class="btn btn-light">Limpar filtros</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf me-1"></i>Exportar PDF</button>
        </div>
    </form>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Animais</h6>
            <p class="mb-2">Inclui identificação, espécie, porte, status e data de cadastro.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Vacinas</h6>
            <p class="mb-2">Animal, tipo de vacina, datas de aplicação e próxima dose.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Rifas</h6>
            <p class="mb-2">Título, prêmio, preço do bilhete, total de números e data do sorteio.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Eventos</h6>
            <p class="mb-2">Título, local, status de publicação e data do evento.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Doações</h6>
            <p class="mb-2">Data, valor, tipo e doador registrado.</p>
        </div>
    </div>
</div>
@endsection
