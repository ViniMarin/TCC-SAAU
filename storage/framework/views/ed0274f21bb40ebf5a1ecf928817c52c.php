<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <?php if($animal->photo_url): ?>
            <img src="<?php echo e($animal->photo_url); ?>" class="img-fluid rounded shadow mb-4" alt="<?php echo e($animal->name); ?>" style="width: 100%; max-height: 500px; object-fit: cover;">
            <?php else: ?>
            <div class="bg-secondary d-flex align-items-center justify-content-center rounded shadow mb-4" style="width: 100%; height: 400px;">
                <i class="fas fa-paw fa-5x text-white"></i>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1 class="mb-3"><?php echo e($animal->name); ?></h1>
            
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Informações</h5>
                    <p class="mb-2"><strong><i class="fas fa-paw"></i> Espécie:</strong> <?php echo e(ucfirst($animal->species)); ?></p>
                    <?php if($animal->breed): ?>
                    <p class="mb-2"><strong><i class="fas fa-dog"></i> Raça:</strong> <?php echo e($animal->breed); ?></p>
                    <?php endif; ?>
                    <?php if($animal->age): ?>
                    <p class="mb-2"><strong><i class="fas fa-calendar"></i> Idade:</strong> <?php echo e($animal->age); ?> <?php echo e($animal->age == 1 ? 'ano' : 'anos'); ?></p>
                    <?php endif; ?>
                    <p class="mb-2"><strong><i class="fas fa-<?php echo e($animal->gender == 'macho' ? 'mars' : 'venus'); ?>"></i> Sexo:</strong> <?php echo e(ucfirst($animal->gender)); ?></p>
                    <?php if($animal->size): ?>
                    <p class="mb-2"><strong><i class="fas fa-ruler"></i> Porte:</strong> <?php echo e(ucfirst($animal->size)); ?></p>
                    <?php endif; ?>
                    <?php if($animal->color): ?>
                    <p class="mb-2"><strong><i class="fas fa-palette"></i> Cor:</strong> <?php echo e($animal->color); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($animal->castrated || $animal->vaccinated || $animal->dewormed): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-heartbeat"></i> Saúde</h5>
                    <?php if($animal->castrated): ?>
                    <p class="mb-1"><i class="fas fa-check text-success"></i> Castrado</p>
                    <?php endif; ?>
                    <?php if($animal->vaccinated): ?>
                    <p class="mb-1"><i class="fas fa-check text-success"></i> Vacinado</p>
                    <?php endif; ?>
                    <?php if($animal->dewormed): ?>
                    <p class="mb-1"><i class="fas fa-check text-success"></i> Vermifugado</p>
                    <?php endif; ?>
                    <?php if($animal->special_needs): ?>
                    <p class="mb-1"><i class="fas fa-exclamation-triangle text-warning"></i> Necessidades Especiais</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if($animal->description): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-align-left"></i> Sobre <?php echo e($animal->name); ?></h5>
                    <p class="mb-0"><?php echo e($animal->description); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
            <?php if(auth()->guard()->check()): ?>
            <h3>Solicitar Adoção</h3>
            <form method="POST" action="<?php echo e(route('adoption.request', $animal->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <input type="text" name="full_name" class="form-control" placeholder="Nome Completo" value="<?php echo e(auth()->user()->name); ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(auth()->user()->email); ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Telefone" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="city_state" class="form-control" placeholder="Cidade/Estado" required>
                </div>
                <div class="mb-3">
                    <select name="housing_type" class="form-control" required>
                        <option value="">Tipo de Moradia</option>
                        <option value="casa">Casa</option>
                        <option value="apartamento">Apartamento</option>
                    </select>
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control" placeholder="Mensagem"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Pedido</button>
            </form>
            <?php else: ?>
            <h3>Solicitar Adoção</h3>
            <p class="alert alert-info">Faça <a href="<?php echo e(route('login')); ?>" class="alert-link">login</a> ou <a href="<?php echo e(route('register')); ?>" class="alert-link">crie sua conta</a> para solicitar adoção de <?php echo e($animal->name); ?>.</p>
            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/public/animal-show.blade.php ENDPATH**/ ?>