<?php $__env->startSection('page-title', 'Pedidos de Adoção'); ?>

<?php $__env->startSection('content'); ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($request->created_at->format('d/m/Y')); ?></td>
                                <td><?php echo e($request->animal->name ?? 'Animal removido'); ?></td>
                                <td><?php echo e($request->adopter_name ?? '-'); ?></td>
                                <td><?php echo e($request->adopter_email ?? '-'); ?></td>
                                <td><?php echo e($request->adopter_phone ?? '-'); ?></td>
                                <td>
                                    <?php
                                        $badgeClass = [
                                            'pendente'  => 'warning',
                                            'aprovado'  => 'success',
                                            'rejeitado' => 'danger',
                                        ][$request->status] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?php echo e($badgeClass); ?>">
                                        <?php echo e(ucfirst($request->status)); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <?php echo $__env->make('admin.partials.action-buttons', [
                                        'view' => route('admin.adoption-requests.show', $request),
                                        'edit' => route('admin.adoption-requests.edit', $request),
                                        'delete' => route('admin.adoption-requests.destroy', $request),
                                        'deleteMessage' => 'Tem certeza que deseja remover este pedido?'
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Nenhum pedido de adoção encontrado.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($requests->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/adoption-requests/index.blade.php ENDPATH**/ ?>