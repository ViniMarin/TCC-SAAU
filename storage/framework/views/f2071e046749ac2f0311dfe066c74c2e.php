<?php $__env->startSection('title', $event->title . ' - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title"><?php echo e($event->title); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $dataFormatada = $event->date
        ? \Carbon\Carbon::parse($event->date)->format('d/m/Y')
        : null;

    $horaFormatada = $event->start_time
        ? \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i')
        : null;
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden event-card-detail">

                <div class="row g-0">
                    
                    <div class="col-md-5">
                        <?php if($event->image_url): ?>
                            <div class="event-cover-wrapper">
                                <img src="<?php echo e($event->image_url); ?>"
                                     alt="Imagem do evento <?php echo e($event->title); ?>"
                                     class="event-cover-img">
                            </div>
                        <?php else: ?>
                            <div class="event-cover-placeholder d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-calendar-alt fa-3x mb-2 text-primary opacity-50"></i>
                                <span class="text-muted small">Sem imagem cadastrada</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="col-md-7">
                        <div class="card-body p-4 p-lg-5 d-flex flex-column h-100">

                            
                            <h2 class="fw-bold text-primary mb-3"><?php echo e($event->title); ?></h2>

                            
                            <div class="mb-3">
                                <p class="text-muted small mb-1 fw-bold">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <?php echo e($dataFormatada ?? 'Data não informada'); ?>

                                    <?php if($horaFormatada): ?>
                                        às <?php echo e($horaFormatada); ?>

                                    <?php endif; ?>
                                </p>
                                <?php if($event->location): ?>
                                    <p class="text-muted small mb-0 fw-bold">
                                        <i class="fas fa-map-marker-alt text-warning me-2"></i>
                                        <?php echo e($event->location); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <hr class="text-muted opacity-25 my-3">

                            
                            <div class="mb-4">
                                <h5 class="fw-bold mb-2 text-secondary">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Sobre o evento
                                </h5>
                                <p class="text-muted" style="line-height: 1.7;">
                                    <?php echo nl2br(e($event->description ?? 'Sem descrição cadastrada.')); ?>

                                </p>
                            </div>

                            
                            <div class="mt-auto d-flex flex-wrap gap-2">
                                <a href="<?php echo e(route('events')); ?>"
                                   class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-1"></i> Voltar para eventos
                                </a>

                                <?php if(!empty($event->link)): ?>
                                    <a href="<?php echo e($event->link); ?>" target="_blank"
                                       class="btn btn-primary rounded-pill px-4">
                                        <i class="fas fa-external-link-alt me-1"></i> Acessar link do evento
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    .event-card-detail {
        background: #ffffff;
    }

    .event-cover-wrapper {
        height: 100%;
        min-height: 260px;
        background-color: #f8f9fa;
    }

    .event-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-cover-placeholder {
        height: 100%;
        min-height: 260px;
        background-color: #f8f9fa;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/event-show.blade.php ENDPATH**/ ?>