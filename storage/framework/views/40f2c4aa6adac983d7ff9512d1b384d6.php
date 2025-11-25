<?php $__env->startSection('title', 'Rifas Solidárias - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">RIFAS SOLIDÁRIAS</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $raffles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raffle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
            
            <div class="card h-100 w-100 border-0 shadow-sm card-custom hover-lift">
                
                
                <div class="position-relative overflow-hidden img-container">
                    <?php if($raffle->image_url): ?>
                        <img src="<?php echo e($raffle->image_url); ?>" class="card-img-top" alt="<?php echo e($raffle->title); ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                            <i class="fas fa-ticket-alt fa-3x text-primary opacity-25"></i>
                        </div>
                    <?php endif; ?>
                    
                    
                    <div class="position-absolute bottom-0 end-0 m-3">
                        <span class="badge bg-warning text-dark shadow fw-bold fs-6 px-3 py-2 rounded-pill">
                            R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?>

                        </span>
                    </div>
                </div>

                
                <div class="card-body p-4 d-flex flex-column text-center">
                    
                    <h4 class="card-title fw-bold text-primary mb-2"><?php echo e($raffle->title); ?></h4>
                    <p class="text-muted small mb-3"><?php echo e(Str::limit($raffle->description, 80)); ?></p>

                    <div class="bg-light rounded-3 p-3 mb-4 border border-light-subtle">
                        <small class="d-block text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">Prêmio</small>
                        <div class="fw-bold text-dark">
                            <i class="fas fa-gift text-warning me-2"></i> <?php echo e($raffle->prize); ?>

                        </div>
                    </div>

                    <div class="mt-auto">
                        <button class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                            PARTICIPAR
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fas fa-ticket-alt fa-4x"></i>
                </div>
                <h4 class="text-dark fw-bold">Nenhuma rifa ativa</h4>
                <p class="text-muted">Aguarde nossas próximas campanhas solidárias.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    /* CSS Padrão (Replicado) */
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
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/public/raffles.blade.php ENDPATH**/ ?>