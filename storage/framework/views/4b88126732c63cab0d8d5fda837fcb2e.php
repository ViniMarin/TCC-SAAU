<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Doações</h1>
        <a href="<?php echo e(route('admin.donations.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Nova Doação
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h3 class="text-success">Total Arrecadado</h3>
            <h1 class="display-4">R$ <?php echo e(number_format($total, 2, ',', '.')); ?></h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                            <th>Doador</th>
                            <th>Observações</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($donation->date)->format('d/m/Y')); ?></td>
                            <td class="text-success fw-bold">R$ <?php echo e(number_format($donation->amount, 2, ',', '.')); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e(ucfirst($donation->donation_type)); ?></span>
                            </td>
                            <td><?php echo e($donation->donor_name ?? 'Anônimo'); ?></td>
                            <td><?php echo e($donation->notes ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.donations.edit', $donation->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.donations.destroy', $donation)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta doação?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma doação registrada.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($donations->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/donations/index.blade.php ENDPATH**/ ?>