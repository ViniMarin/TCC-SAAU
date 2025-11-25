<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Doações</h1>
        <a href="<?php echo e(route('admin.donations.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Nova Doação
        </a>
    </div>

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
                            <th class="align-middle text-center">Data</th>
                            <th class="align-middle text-center">Valor</th>
                            <th class="align-middle text-center">Tipo</th>
                            <th class="align-middle">Doador</th>
                            <th class="align-middle">Observações</th>
                            <th class="align-middle text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="align-middle text-center"><?php echo e(\Carbon\Carbon::parse($donation->date)->format('d/m/Y')); ?></td>
                            <td class="align-middle text-center text-success fw-bold">R$ <?php echo e(number_format($donation->amount, 2, ',', '.')); ?></td>
                            <td class="align-middle text-center">
                                <?php
                                    $typeLabels = [
                                        'dinheiro' => 'Dinheiro',
                                        'racao' => 'Ração',
                                        'medicamento' => 'Medicamento',
                                        'outro' => 'Outro',
                                    ];
                                ?>
                                <span class="badge bg-info"><?php echo e($typeLabels[$donation->type] ?? ucfirst($donation->type)); ?></span>
                            </td>
                            <td><?php echo e($donation->donor_name ?? 'Anônimo'); ?></td>
                            <td><?php echo e($donation->notes ?? '-'); ?></td>
                            <td>
                                <?php echo $__env->make('admin.partials.action-buttons', [
                                    'view' => route('admin.donations.show', $donation),
                                    'edit' => route('admin.donations.edit', $donation->id),
                                    'delete' => route('admin.donations.destroy', $donation),
                                    'deleteMessage' => 'Tem certeza que deseja remover esta doação?'
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/admin/donations/index.blade.php ENDPATH**/ ?>