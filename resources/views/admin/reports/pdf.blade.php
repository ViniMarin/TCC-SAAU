<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 20px; color: #2c3e50; }
        h1 { margin-bottom: 4px; }
        h2 { margin-top: 24px; margin-bottom: 8px; color: #34495e; }
        .meta { font-size: 12px; color: #7f8c8d; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #dfe6e9; padding: 8px; font-size: 12px; }
        th { background: #f5f7fa; text-align: left; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; color: white; }
        .badge-success { background: #27ae60; }
        .badge-warning { background: #f39c12; }
        .badge-danger { background: #e74c3c; }
        .section { page-break-inside: avoid; }
    </style>
</head>
<body>
    @php
        use Carbon\Carbon;
    @endphp

    <h1>Relatório do Painel Admin</h1>
    <div class="meta">
        <div>Tipo: {{ $type === 'all' ? 'Completo (todos os módulos)' : ucfirst($type) }}</div>
        <div>Gerado em: {{ $generatedAt->format('d/m/Y H:i') }}</div>
        @if($startDate || $endDate)
            <div>Período: {{ $startDate?->format('d/m/Y') ?? 'início' }} até {{ $endDate?->format('d/m/Y') ?? 'hoje' }}</div>
        @endif
    </div>

    @if(isset($reports['animals']))
    <div class="section">
        <h2>Animais ({{ $reports['animals']->count() }})</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Porte</th>
                    <th>Status</th>
                    <th>Castrado</th>
                    <th>Vacinado</th>
                    <th>Cadastro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports['animals'] as $animal)
                <tr>
                    <td>{{ $animal->id }}</td>
                    <td>{{ $animal->name }}</td>
                    <td>{{ ucfirst($animal->species) }}</td>
                    <td>{{ $animal->breed ?? '-' }}</td>
                    <td>{{ $animal->size ?? '-' }}</td>
                    <td>{{ $animal->status }}</td>
                    <td>{{ $animal->castrated ? 'Sim' : 'Não' }}</td>
                    <td>{{ $animal->vaccinated ? 'Sim' : 'Não' }}</td>
                    <td>{{ $animal->created_at?->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="9">Nenhum animal encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($reports['vaccines']))
    <div class="section">
        <h2>Vacinas ({{ $reports['vaccines']->count() }})</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal</th>
                    <th>Tipo</th>
                    <th>Aplicação</th>
                    <th>Próxima Dose</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports['vaccines'] as $vaccine)
                <tr>
                    <td>{{ $vaccine->id }}</td>
                    <td>{{ $vaccine->animal->name ?? 'N/A' }}</td>
                    <td>{{ $vaccine->vaccine_type }}</td>
                    <td>{{ $vaccine->application_date?->format('d/m/Y') }}</td>
                    <td>{{ $vaccine->next_dose_date?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $vaccine->notes ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6">Nenhuma vacina encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($reports['raffles']))
    <div class="section">
        <h2>Rifas ({{ $reports['raffles']->count() }})</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Prêmio</th>
                    <th>Preço Bilhete</th>
                    <th>Total de Bilhetes</th>
                    <th>Data do Sorteio</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports['raffles'] as $raffle)
                <tr>
                    <td>{{ $raffle->id }}</td>
                    <td>{{ $raffle->title }}</td>
                    <td>{{ $raffle->prize }}</td>
                    <td>R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</td>
                    <td>{{ $raffle->total_tickets }}</td>
                    <td>{{ $raffle->draw_date?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $raffle->status }}</td>
                </tr>
                @empty
                <tr><td colspan="7">Nenhuma rifa encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($reports['events']))
    <div class="section">
        <h2>Eventos ({{ $reports['events']->count() }})</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Local</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports['events'] as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->date?->format('d/m/Y') }}</td>
                    <td>{{ $event->active ? 'Publicado' : 'Rascunho' }}</td>
                </tr>
                @empty
                <tr><td colspan="5">Nenhum evento encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($reports['donations']))
    <div class="section">
        <h2>Doações ({{ $reports['donations']->count() }})</h2>
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
                @forelse($reports['donations'] as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->date?->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($donation->amount, 2, ',', '.') }}</td>
                    <td>{{ $donation->type }}</td>
                    <td>{{ $donation->donor_name ?? 'Anônimo' }}</td>
                    <td>{{ $donation->description ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6">Nenhuma doação encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
</body>
</html>
