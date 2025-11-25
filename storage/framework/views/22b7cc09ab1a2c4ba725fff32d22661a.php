<?php
    $view = $view ?? null;
    $edit = $edit ?? null;
    $delete = $delete ?? null;
    $deleteMessage = $deleteMessage ?? 'Tem certeza que deseja remover este registro?';
?>

<div class="d-inline-flex align-items-center gap-2 action-buttons">
    <?php if($view): ?>
    <a href="<?php echo e($view); ?>" class="btn btn-sm action-btn btn-view" title="Visualizar">
        <i class="fas fa-eye"></i>
    </a>
    <?php endif; ?>

    <?php if($edit): ?>
    <a href="<?php echo e($edit); ?>" class="btn btn-sm btn-warning action-btn" title="Editar">
        <i class="fas fa-edit"></i>
    </a>
    <?php endif; ?>

    <?php if($delete): ?>
    <form action="<?php echo e($delete); ?>" method="POST" class="m-0" onsubmit="return confirm('<?php echo e($deleteMessage); ?>')">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-sm btn-danger action-btn" title="Excluir">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/partials/action-buttons.blade.php ENDPATH**/ ?>