@php
    $view = $view ?? null;
    $edit = $edit ?? null;
    $delete = $delete ?? null;
    $deleteMessage = $deleteMessage ?? 'Tem certeza que deseja remover este registro?';
@endphp

<div class="d-inline-flex align-items-center gap-2 action-buttons">
    @if($view)
    <a href="{{ $view }}" class="btn btn-sm btn-outline-primary action-btn" title="Visualizar">
        <i class="fas fa-eye"></i>
    </a>
    @endif

    @if($edit)
    <a href="{{ $edit }}" class="btn btn-sm btn-warning action-btn" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
    @endif

    @if($delete)
    <form action="{{ $delete }}" method="POST" class="m-0" onsubmit="return confirm('{{ $deleteMessage }}')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger action-btn" title="Excluir">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    @endif
</div>
