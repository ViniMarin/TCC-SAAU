@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Rifas</h1>
        <a href="{{ route('admin.raffles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Nova Rifa
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Imagem</th>
                            <th class="align-middle">Título</th>
                            <th class="align-middle">Prêmio</th>
                            <th class="align-middle text-center">Valor do Bilhete</th>
                            <th class="align-middle text-center">Total de Bilhetes</th>
                            <th class="align-middle text-center">Data do Sorteio</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($raffles as $raffle)
                        <tr>
                            <td class="align-middle text-center">
                                @if($raffle->image_url)
                                <img src="{{ $raffle->image_url }}" alt="{{ $raffle->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $raffle->title }}</td>
                            <td>{{ $raffle->prize ?? '-' }}</td>
                            <td>R$ {{ number_format($raffle->ticket_price, 2, ',', '.') }}</td>
                            <td>{{ $raffle->total_tickets }}</td>
                            <td>{{ \Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $raffle->status === 'ativa' ? 'success' : ($raffle->status === 'pausada' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($raffle->status) }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-inline-flex align-items-center gap-2">
                                    <a href="{{ route('admin.raffles.edit', $raffle) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.raffles.destroy', $raffle) }}" method="POST" class="m-0" onsubmit="return confirm('Tem certeza que deseja remover esta rifa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Nenhuma rifa cadastrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $raffles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
