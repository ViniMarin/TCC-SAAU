@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Doações</h1>
        <a href="{{ route('admin.donations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Nova Doação
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h3 class="text-success">Total Arrecadado</h3>
            <h1 class="display-4">R$ {{ number_format($total, 2, ',', '.') }}</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Data</th>
                            <th class="align-middle text-center">Valor</th>
                            <th class="align-middle text-center">Tipo</th>
                            <th class="align-middle">Doador</th>
                            <th class="align-middle">Observações</th>
                            <th class="align-middle text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($donation->date)->format('d/m/Y') }}</td>
                            <td class="align-middle text-center text-success fw-bold">R$ {{ number_format($donation->amount, 2, ',', '.') }}</td>
                            <td class="align-middle text-center">
                                @php
                                    $typeLabels = [
                                        'dinheiro' => 'Dinheiro',
                                        'racao' => 'Ração',
                                        'medicamento' => 'Medicamento',
                                        'outro' => 'Outro',
                                    ];
                                @endphp
                                <span class="badge bg-info">{{ $typeLabels[$donation->type] ?? ucfirst($donation->type) }}</span>
                            </td>
                            <td>{{ $donation->donor_name ?? 'Anônimo' }}</td>
                            <td>{{ $donation->notes ?? '-' }}</td>
                            <td>
<<<<<<< ours
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.donations.edit', $donation->id) }}" class="btn btn-sm btn-warning d-flex align-items-center justify-content-center text-white" style="width: 36px; height: 36px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta doação?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center text-white" style="width: 36px; height: 36px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
=======
                                @include('admin.partials.action-buttons', [
                                    'view' => route('admin.donations.show', $donation),
                                    'edit' => route('admin.donations.edit', $donation->id),
                                    'delete' => route('admin.donations.destroy', $donation),
                                    'deleteMessage' => 'Tem certeza que deseja remover esta doação?'
                                ])
>>>>>>> theirs
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma doação registrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
