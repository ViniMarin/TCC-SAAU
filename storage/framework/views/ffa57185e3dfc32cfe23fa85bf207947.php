<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1 class="mb-4"><?php echo e($event->title); ?></h1>

            <?php if($event->image_url): ?>
            <img src="<?php echo e($event->image_url); ?>" class="img-fluid rounded mb-4" alt="Imagem do evento <?php echo e($event->title); ?>">
            <?php else: ?>
            <div class="bg-light d-flex align-items-center justify-content-center rounded mb-4" style="height: 300px;">
                <i class="fas fa-calendar-alt fa-5x text-muted"></i>
            </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Detalhes</h5>
                    <p class="card-text"><?php echo nl2br(e($event->description)); ?></p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar"></i> Data e Hora</h5>
                            <p class="card-text"><?php echo e(\Carbon\Carbon::parse($event->date)->format('d/m/Y')); ?> às <?php echo e(\Carbon\Carbon::parse($event->date)->format('H:i')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Local</h5>
                            <p class="card-text"><?php echo e($event->location); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($event->link): ?>
            <div class="text-center mt-5">
                <a href="<?php echo e($event->link); ?>" target="_blank" class="btn btn-primary btn-lg">
                    <i class="fas fa-external-link-alt"></i> Link do Evento
                </a>
            </div>
            <?php endif; ?>

            <div class="mt-5">
                <a href="<?php echo e(route('events')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar para Eventos</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\TCC\TCC-SAAU\resources\views/public/event-show.blade.php ENDPATH**/ ?>