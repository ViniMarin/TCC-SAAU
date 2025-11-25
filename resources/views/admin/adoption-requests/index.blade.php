@extends('layouts.admin')

@section('page-title', 'Pedidos de Adoção')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pedidos de Adoção</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Animal</th>
                            <th>Adotante</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $request->created_at->format('d/m/Y') }}</td>
                                <td>{{ $request->animal->name ?? 'Animal removido' }}</td>
                                <td>{{ $request->adopter_name ?? '-' }}</td>
                                <td>{{ $request->adopter_email ?? '-' }}</td>
                                <td>{{ $request->adopter_phone ?? '-' }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'pendente'  => 'warning',
                                            'aprovado'  => 'success',
                                            'rejeitado' => 'danger',
                                        ][$request->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    @include('admin.partials.action-buttons', [
                                        'view' => route('admin.adoption-requests.show', $request),
                                        'edit' => route('admin.adoption-requests.edit', $request),
                                        'delete' => route('admin.adoption-requests.destroy', $request),
                                        'deleteMessage' => 'Tem certeza que deseja remover este pedido?'
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Nenhum pedido de adoção encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
