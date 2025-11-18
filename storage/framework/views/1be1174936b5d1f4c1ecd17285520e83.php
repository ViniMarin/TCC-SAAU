<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Histórias de Adoção</h1>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5><?php echo e($story->title); ?></h5>
                    <p><?php echo e(Str::limit($story->story, 150)); ?></p>
                    <p><small>Por: <?php echo e($story->adopter_name); ?></small></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhuma história aprovada.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/public/stories.blade.php ENDPATH**/ ?>