<?php $__env->startSection('content'); ?>
<div class="hero">
    <div class="container">
        <h1 class="display-3"><i class="fas fa-heart"></i> Adote um Amigo</h1>
        <p class="lead">Dê uma segunda chance para um animal que precisa de amor e carinho</p>
        <a href="<?php echo e(route('animals')); ?>" class="btn btn-light btn-lg mt-3">Ver Animais Disponíveis</a>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-primary"><?php echo e($stats['animals']); ?></h2>
                <p>Animais Cadastrados</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-success"><?php echo e($stats['adopted']); ?></h2>
                <p>Adoções Realizadas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-info"><?php echo e($stats['events']); ?></h2>
                <p>Eventos Ativos</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h2 class="text-warning"><?php echo e($stats['raffles']); ?></h2>
                <p>Rifas Ativas</p>
            </div>
        </div>
    </div>

    <h2 class="text-center mb-4">Animais Disponíveis para Adoção</h2>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if($animal->photo_url): ?>
                <img src="<?php echo e($animal->photo_url); ?>" class="card-img-top" alt="<?php echo e($animal->name); ?>" style="height: 250px; object-fit: cover;">
                <?php else: ?>
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="fas fa-paw fa-4x text-white"></i>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($animal->name); ?></h5>
                    <p class="card-text">
                        <i class="fas fa-paw"></i> <?php echo e(ucfirst($animal->species)); ?> | 
                        <i class="fas fa-<?php echo e($animal->gender == 'macho' ? 'mars' : 'venus'); ?>"></i> <?php echo e(ucfirst($animal->gender)); ?><br>
                        <?php if($animal->age): ?>
                        <i class="fas fa-calendar"></i> <?php echo e($animal->age); ?> <?php echo e($animal->age == 1 ? 'ano' : 'anos'); ?><br>
                        <?php endif; ?>
                        <?php if($animal->size): ?>
                        <i class="fas fa-ruler"></i> Porte <?php echo e(ucfirst($animal->size)); ?>

                        <?php endif; ?>
                    </p>
                    <p><?php echo e(Str::limit($animal->description, 80)); ?></p>
                    <a href="<?php echo e(route('animal.show', $animal->id)); ?>" class="btn btn-primary w-100">
                        <i class="fas fa-heart"></i> Quero Adotar
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center">
            <p>Nenhum animal disponível no momento.</p>
        </div>
        <?php endif; ?>
    </div>
    <div class="text-center mt-4">
        <a href="<?php echo e(route('animals')); ?>" class="btn btn-outline-primary">Ver Todos os Animais</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/public/home.blade.php ENDPATH**/ ?>