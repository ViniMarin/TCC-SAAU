<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Rifas</h1>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $raffles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raffle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5><?php echo e($raffle->title); ?></h5>
                    <p><?php echo e($raffle->description); ?></p>
                    <p><strong>Prêmio:</strong> <?php echo e($raffle->prize); ?></p>
                    <p><strong>Valor:</strong> R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">Nenhuma rifa ativa.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/public/raffles.blade.php ENDPATH**/ ?>