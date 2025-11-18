<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Histórias de Adoção</h1>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <?php if($story->photo_url): ?>
                <img src="<?php echo e($story->photo_url); ?>" class="card-img-top" alt="<?php echo e($story->pet_name); ?>" style="height: 250px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($story->pet_name); ?></h5>
                    <p class="card-text"><strong>Adotante:</strong> <?php echo e($story->adopter_name); ?></p>
                    <p class="card-text"><?php echo e(Str::limit($story->story, 150)); ?></p>
                    <p class="card-text">
                        <small class="text-muted"><?php echo e($story->created_at->format('d/m/Y')); ?></small>
                        <?php if($story->approved): ?>
                        <span class="badge bg-success">Aprovada</span>
                        <?php else: ?>
                        <span class="badge bg-warning">Pendente</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2">
                        <?php if(!$story->approved): ?>
                        <form action="<?php echo e(route('admin.stories.approve', $story)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Aprovar
                            </button>
                        </form>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.stories.destroy', $story)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta história?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="alert alert-info">
                Nenhuma história de adoção cadastrada ainda.
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <?php echo e($stories->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/stories/index.blade.php ENDPATH**/ ?>