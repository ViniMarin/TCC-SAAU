<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
    <style>
        * { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; }
        body { font-size: 12px; color: #1f2937; margin: 24px; }
        h1 { font-size: 22px; margin-bottom: 6px; color: #111827; }
        h2 { font-size: 16px; margin: 20px 0 8px; color: #111827; }
        p.meta { margin: 2px 0; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { border: 1px solid #e5e7eb; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; font-weight: bold; color: #111827; }
        .muted { color: #6b7280; }
        .section { page-break-inside: avoid; margin-bottom: 12px; }
    </style>
</head>
<body>
    @php
        $periodo = 'Todos os registros';

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $periodo = $filters['start_date'] . ' a ' . $filters['end_date'];
        } elseif (!empty($filters['start_date'])) {
            $periodo = 'A partir de ' . $filters['start_date'];
        } elseif (!empty($filters['end_date'])) {
            $periodo = 'Até ' . $filters['end_date'];
        }
    @endphp

    <h1>Relatório {{ $filters['type'] === 'all' ? 'Completo' : ucfirst($filters['type']) }}</h1>
    <p class="meta">Período: {{ $periodo }}</p>
    <p class="meta">Gerado em: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    @if($animals->count())
        <div class="section">
            <h2>Animais ({{ $animals->count() }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Raça</th>
                        <th>Status</th>
                        <th>Castrado</th>
                        <th>Vacinado</th>
                        <th>Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                        <tr>
                            <td>{{ $animal->id }}</td>
                            <td>{{ $animal->name }}</td>
                            <td>{{ $animal->species }}</td>
                            <td>{{ $animal->breed ?? '-' }}</td>
                            <td>{{ $animal->status }}</td>
                            <td>{{ $animal->castrated ? 'Sim' : 'Não' }}</td>
                            <td>{{ $animal->vaccinated ? 'Sim' : 'Não' }}</td>
                            <td>{{ optional($animal->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($filters['type'] === 'all' || $filters['type'] === 'animals')
        <p class="muted">Nenhum animal encontrado no período selecionado.</p>
    @endif

    @if($vaccines->count())
        <div class="section">
            <h2>Vacinas ({{ $vaccines->count() }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Animal</th>
                        <th>Tipo</th>
                        <th>Aplicação</th>
                        <th>Próxima dose</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vaccines as $vaccine)
                        <tr>
                            <td>{{ $vaccine->id }}</td>
                            <td>{{ $vaccine->animal->name ?? 'N/A' }}</td>
                            <td>{{ $vaccine->vaccine_type }}</td>
                            <td>{{ optional($vaccine->application_date)->format('d/m/Y') }}</td>
                            <td>{{ $vaccine->next_dose_date ? optional($vaccine->next_dose_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $vaccine->notes ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($filters['type'] === 'all' || $filters['type'] === 'vaccines')
        <p class="muted">Nenhuma vacina encontrada no período selecionado.</p>
    @endif

    @if($raffles->count())
        <div class="section">
            <h2>Rifas ({{ $raffles->count() }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Prêmio</th>
                        <th>Valor do bilhete</th>
                        <th>Data do sorteio</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($raffles as $raffle)
                        <tr>
                            <td>{{ $raffle->id }}</td>
                            <td>{{ $raffle->title }}</td>
                            <td>{{ $raffle->prize ?? '-' }}</td>
                            <td>R$ {{ number_format((float) $raffle->ticket_price, 2, ',', '.') }}</td>
                            <td>{{ optional($raffle->draw_date)->format('d/m/Y') }}</td>
                            <td>{{ $raffle->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($filters['type'] === 'all' || $filters['type'] === 'raffles')
        <p class="muted">Nenhuma rifa encontrada no período selecionado.</p>
    @endif

    @if($events->count())
        <div class="section">
            <h2>Eventos ({{ $events->count() }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ optional($event->date)->format('d/m/Y') }}</td>
                            <td>{{ $event->location ?? '-' }}</td>
                            <td>{{ $event->active ? 'Ativo' : 'Inativo' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($filters['type'] === 'all' || $filters['type'] === 'events')
        <p class="muted">Nenhum evento encontrado no período selecionado.</p>
    @endif

    @if($donations->count())
        <div class="section">
            <h2>Doações ({{ $donations->count() }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Doador</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>{{ optional($donation->date)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format((float) $donation->amount, 2, ',', '.') }}</td>
                            <td>{{ $donation->type }}</td>
                            <td>{{ $donation->donor_name ?? 'Anônimo' }}</td>
                            <td>{{ $donation->description ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($filters['type'] === 'all' || $filters['type'] === 'donations')
        <p class="muted">Nenhuma doação encontrada no período selecionado.</p>
    @endif
</body>
</html>
