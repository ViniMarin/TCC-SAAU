
<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h1 class="mb-0">Histórias de Adoção</h1>
        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->role === 'adotante'): ?>
            <a href="<?php echo e(route('stories.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Cadastrar história
            </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if($story->photo_url): ?>
                <img src="<?php echo e($story->photo_url); ?>" class="card-img-top" alt="<?php echo e($story->animal_name); ?>" style="height: 220px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($story->animal_name); ?></h5>
                    <p class="card-text"><?php echo e(Str::limit($story->story, 150)); ?></p>
                    <p class="card-text"><small>Por: <?php echo e($story->adopter_name); ?></small></p> 
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhuma história aprovada.</p>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <?php echo e($stories->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/public/stories.blade.php ENDPATH**/ ?>