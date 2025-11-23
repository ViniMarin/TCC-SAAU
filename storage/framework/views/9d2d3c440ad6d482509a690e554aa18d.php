<?php $__env->startSection('content'); ?>
<div class="container-fluid my-5 px-4 px-lg-5">
    <h1 class="text-center mb-4">Animais Disponíveis</h1>

    <div class="row g-4">
        
        <div class="col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Filtrar</h5>
                    <form method="GET" action="<?php echo e(route('animals')); ?>">
                        <div class="mb-3">
                            <label class="form-label">Espécie</label>
                            <select name="species" class="form-control">
                                <option value="">Todas</option>
                                <option value="cão"  <?php echo e(request('species') == 'cão' ? 'selected' : ''); ?>>Cão</option>
                                <option value="gato" <?php echo e(request('species') == 'gato' ? 'selected' : ''); ?>>Gato</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select name="gender" class="form-control">
                                <option value="">Todos</option>
                                <option value="macho" <?php echo e(request('gender') == 'macho' ? 'selected' : ''); ?>>Macho</option>
                                <option value="fêmea" <?php echo e(request('gender') == 'fêmea' ? 'selected' : ''); ?>>Fêmea</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Idade</label>
                            <select name="age" class="form-control">
                                <option value="">Todas</option>
                                <option value="filhote" <?php echo e(request('age') == 'filhote' ? 'selected' : ''); ?>>Filhote</option>
                                <option value="adulto"  <?php echo e(request('age') == 'adulto' ? 'selected' : ''); ?>>Adulto</option>
                                <option value="idoso"   <?php echo e(request('age') == 'idoso' ? 'selected' : ''); ?>>Idoso</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Porte</label>
                            <select name="size" class="form-control">
                                <option value="">Todos</option>
                                <option value="pequeno" <?php echo e(request('size') == 'pequeno' ? 'selected' : ''); ?>>Pequeno</option>
                                <option value="médio"   <?php echo e(request('size') == 'médio' ? 'selected' : ''); ?>>Médio</option>
                                <option value="grande"  <?php echo e(request('size') == 'grande' ? 'selected' : ''); ?>>Grande</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                            <a href="<?php echo e(route('animals')); ?>" class="btn btn-outline-secondary">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-lg-9">
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100 position-relative">
                        <?php if($animal->special_needs): ?>
                        <span class="badge bg-warning text-dark position-absolute" style="top: 10px; right: 10px;">Necessidades Especiais</span>
                        <?php endif; ?>

                        <?php if($animal->photo_url): ?>
                        <img src="<?php echo e($animal->photo_url); ?>" class="card-img-top" alt="<?php echo e($animal->name); ?>" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="fas fa-paw fa-4x text-white"></i>
                        </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <?php
                                $genderIcon = $animal->gender === 'macho' ? 'mars' : 'venus';
                                $genderLabel = $animal->gender === 'macho' ? 'Macho' : 'Fêmea';
                            ?>
                            <h5 class="card-title"><?php echo e($animal->name); ?></h5>
                            <p class="card-text">
                                <i class="fas fa-paw"></i> <?php echo e(ucfirst($animal->species)); ?> |
                                <i class="fas fa-<?php echo e($genderIcon); ?>"></i> <?php echo e($genderLabel); ?><br>

                                <?php if($animal->age): ?>
                                <i class="fas fa-calendar"></i> <?php echo e(ucfirst($animal->age)); ?><br>
                                <?php endif; ?>

                                <?php if($animal->size): ?>
                                <i class="fas fa-ruler"></i> Porte <?php echo e(ucfirst($animal->size)); ?>

                                <?php endif; ?>
                            </p>
                            <a href="<?php echo e(route('animal.show', $animal->id)); ?>" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-heart"></i> Ver Detalhes e Adotar
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center">Nenhum animal disponível.</p>
                <?php endif; ?>
            </div>

            
            <?php echo e($animals->withQueryString()->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/public/animals.blade.php ENDPATH**/ ?>