<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Eventos</h1>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if($event->image_url): ?>
                <img src="<?php echo e($event->image_url); ?>" class="card-img-top" alt="Imagem do evento <?php echo e($event->title); ?>" style="height: 200px; object-fit: cover;">
                <?php else: ?>
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-calendar fa-3x text-muted"></i>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5><?php echo e($event->title); ?></h5>
                    <p><?php echo e($event->description); ?></p>
                    <p><i class="fas fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($event->date)->format('d/m/Y')); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo e($event->location); ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('event.show', $event->id)); ?>" class="btn btn-sm btn-outline-primary w-100">Saiba Mais</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhum evento ativo.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\TCC\TCC-SAAU\resources\views/public/events.blade.php ENDPATH**/ ?>