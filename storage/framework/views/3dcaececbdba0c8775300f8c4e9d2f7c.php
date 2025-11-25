

<?php $__env->startSection('title', 'História de ' . $story->animal_name . ' - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">HISTÓRIA DE <?php echo e(strtoupper($story->animal_name)); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <?php
                $photoUrl = $story->photo_url
                    ? (\Illuminate\Support\Str::startsWith($story->photo_url, ['http://', 'https://', '/'])
                        ? $story->photo_url
                        : \Illuminate\Support\Facades\Storage::url($story->photo_url))
                    : null;
            ?>

            
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                
                <div class="position-relative story-image-wrapper">
                    <?php if($photoUrl): ?>
                        <img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($story->animal_name); ?>" class="w-100">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 320px;">
                            <i class="fas fa-heart fa-4x text-danger opacity-25"></i>
                        </div>
                    <?php endif; ?>

                    <div class="position-absolute bottom-0 start-0 w-100 px-4 py-3 bg-gradient-dark text-white">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-2"
                                 style="width: 34px; height: 34px;">
                                <i class="fas fa-user small"></i>
                            </div>
                            <span class="fw-semibold text-shadow small">
                                Adotado por <?php echo e($story->adopter_name); ?>

                            </span>
                        </div>
                    </div>
                </div>

                
                <div class="card-body p-4 p-md-5">
                    <h2 class="h4 fw-bold text-primary mb-2"><?php echo e($story->animal_name); ?></h2>
                    <p class="text-muted small mb-4">
                        História compartilhada em <?php echo e($story->created_at->format('d/m/Y')); ?>

                    </p>

                    <p class="mb-0" style="line-height: 1.8; white-space: pre-line;">
                        <?php echo e($story->story); ?>

                    </p>
                </div>
            </div>

            
            <div class="mt-4">
                <a href="<?php echo e(route('stories.index')); ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar para histórias
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .story-image-wrapper img {
        max-height: 420px;
        object-fit: cover;
        display: block;
    }
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    .text-shadow {
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/story-show.blade.php ENDPATH**/ ?>