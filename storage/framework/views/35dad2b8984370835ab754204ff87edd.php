<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Rifas</h1>

    <?php if($eventsWithImages->count()): ?>
    <section class="mb-5">
        <h2 class="h4 mb-3 text-center">Eventos com Imagens</h2>
        <div class="row">
            <?php $__currentLoopData = $eventsWithImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo e($event->image_url); ?>" class="card-img-top" alt="<?php echo e($event->title); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5><?php echo e($event->title); ?></h5>
                        <p class="mb-2"><?php echo e($event->description); ?></p>
                        <p class="mb-1"><i class="fas fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($event->date)->format('d/m/Y')); ?></p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo e($event->location); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $raffles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raffle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if($raffle->image_url): ?>
                <img src="<?php echo e($raffle->image_url); ?>" class="card-img-top" alt="<?php echo e($raffle->title); ?>" style="height: 200px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5><?php echo e($raffle->title); ?></h5>
                    <p><?php echo e($raffle->description); ?></p>
                    <p><strong>Prêmio:</strong> <?php echo e($raffle->prize); ?></p>
                    <p><strong>Valor:</strong> R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('raffle.show', $raffle)); ?>" class="btn btn-sm btn-primary w-100">Comprar Bilhetes</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhuma rifa ativa.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\TCC\TCC-SAAU\resources\views/public/raffles.blade.php ENDPATH**/ ?>