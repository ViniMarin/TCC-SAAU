<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Eventos</h1>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5><?php echo e($event->title); ?></h5>
                    <p><?php echo e($event->description); ?></p>
                    <p><i class="fas fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($event->date)->format('d/m/Y')); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo e($event->location); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhum evento ativo.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/public/events.blade.php ENDPATH**/ ?>