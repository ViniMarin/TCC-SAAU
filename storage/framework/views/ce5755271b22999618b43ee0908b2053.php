<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="mb-4">Pedidos de Adoção</h1>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Animal</th>
                            <th>Adotante</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($request->created_at->format('d/m/Y')); ?></td>
                            <td><?php echo e($request->animal->name ?? 'N/A'); ?></td>
                            <td><?php echo e($request->adopter_name); ?></td>
                            <td><?php echo e($request->adopter_email); ?></td>
                            <td><?php echo e($request->adopter_phone); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($request->status == 'pendente' ? 'warning' : ($request->status == 'aprovado' ? 'success' : 'danger')); ?>">
                                    <?php echo e(ucfirst($request->status)); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.adoption-requests.show', $request)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="<?php echo e(route('admin.adoption-requests.destroy', $request)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
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
                            <td colspan="7" class="text-center">Nenhum pedido de adoção.</td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/adoption-requests/index.blade.php ENDPATH**/ ?>