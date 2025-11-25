<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Vacinas</h1>
        <a href="<?php echo e(route('admin.vaccines.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Registrar Nova Vacina
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Animal</th>
                            <th>Tipo de Vacina</th>
                            <th>Data de Aplicação</th>
                            <th>Próxima Dose</th>
                            <th>Observações</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $vaccines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaccine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($vaccine->animal->name ?? 'N/A'); ?></td>
                            <td><?php echo e($vaccine->vaccine_type); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($vaccine->application_date)->format('d/m/Y')); ?></td>
                            <td>
                                <?php if($vaccine->next_dose_date): ?>
                                <?php echo e(\Carbon\Carbon::parse($vaccine->next_dose_date)->format('d/m/Y')); ?>

                                <?php else: ?>
                                -
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($vaccine->notes ?? '-'); ?></td>
                            <td>
                                <?php echo $__env->make('admin.partials.action-buttons', [
                                    'view' => route('admin.vaccines.show', $vaccine),
                                    'edit' => route('admin.vaccines.edit', $vaccine->id),
                                    'delete' => route('admin.vaccines.destroy', $vaccine),
                                    'deleteMessage' => 'Tem certeza que deseja remover este registro?'
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma vacina registrada.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($vaccines->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/admin/vaccines/index.blade.php ENDPATH**/ ?>