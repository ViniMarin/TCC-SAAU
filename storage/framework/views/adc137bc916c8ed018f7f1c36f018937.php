<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Animais</h1>
        <a href="<?php echo e(route('admin.animals.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Cadastrar Novo Animal
        </a>
    </div>

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
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Raça</th>
                            <th>Idade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($animal->photo_url): ?>
                                <img src="<?php echo e($animal->photo_url); ?>" alt="<?php echo e($animal->name); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($animal->name); ?></td>
                            <td><?php echo e(ucfirst($animal->species)); ?></td>
                            <td><?php echo e($animal->breed ?? '-'); ?></td>
                            <td><?php echo e($animal->age ? $animal->age . ' anos' : '-'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($animal->status == 'disponivel' ? 'success' : ($animal->status == 'adotado' ? 'info' : 'warning')); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $animal->status))); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.animals.edit', $animal)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.animals.destroy', $animal)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este animal?')">
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
                            <td colspan="7" class="text-center">Nenhum animal cadastrado.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($animals->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/animals/index.blade.php ENDPATH**/ ?>