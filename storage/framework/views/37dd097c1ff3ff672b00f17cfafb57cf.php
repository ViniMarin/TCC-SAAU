<?php $__env->startSection('title', 'Eventos - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">EVENTOS</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
            
            <div class="card h-100 w-100 border-0 shadow-sm card-custom hover-lift">
                
                
                <div class="position-relative overflow-hidden img-container">
                    <?php if($event->image_url): ?>
                        <img src="<?php echo e($event->image_url); ?>" class="card-img-top" alt="<?php echo e($event->title); ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt fa-3x text-primary opacity-25"></i>
                        </div>
                    <?php endif; ?>

                    
                    <div class="position-absolute top-0 end-0 m-3 bg-white rounded-3 shadow-sm text-center p-2" style="min-width: 60px;">
                        <span class="d-block text-primary fw-bold small text-uppercase"><?php echo e(\Carbon\Carbon::parse($event->date)->format('M')); ?></span>
                        <span class="d-block text-dark fw-800 fs-4 lh-1"><?php echo e(\Carbon\Carbon::parse($event->date)->format('d')); ?></span>
                    </div>
                </div>

                
                <div class="card-body p-4 d-flex flex-column">
                    
                    
                    <h4 class="card-title fw-bold text-primary mb-2"><?php echo e($event->title); ?></h4>
                    
                    
                    <p class="text-muted small mb-3 fw-bold">
                        <i class="fas fa-map-marker-alt text-warning me-2"></i> <?php echo e($event->location); ?>

                    </p>

                    <hr class="text-muted opacity-25 my-3">

                    
                    <p class="card-text text-muted small flex-grow-1 mb-4">
                        <?php echo e(Str::limit($event->description, 120)); ?>

                    </p>

                    
                    <div class="mt-auto">
                        <button class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                            SAIBA MAIS
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <div class="mb-3 text-muted opacity-50">
                    <i class="far fa-calendar-times fa-4x"></i>
                </div>
                <h4 class="text-dark fw-bold">Nenhum evento programado</h4>
                <p class="text-muted">Fique ligado em nossas redes sociais para novidades!</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    /* CSS Padrão para Cards (Reutilizável) */
    .card-custom {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        overflow: hidden;
    }

    .img-container {
        height: 240px;
        background-color: #f8f9fa;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15) !important;
    }

    .hover-lift:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .fw-800 { font-weight: 800; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/events.blade.php ENDPATH**/ ?>