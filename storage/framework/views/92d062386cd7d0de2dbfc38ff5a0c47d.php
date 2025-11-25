<?php $__env->startSection('title', 'Quero Adotar - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">QUERO ADOTAR</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row g-4">
        
        
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold text-primary mb-0">
                        <i class="fas fa-filter text-warning me-2"></i> Filtrar Busca
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="GET" action="<?php echo e(route('animals')); ?>">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Espécie</label>
                            <select name="species" class="form-select rounded-pill bg-light border-0 text-dark">
                                <option value="">Todas</option>
                                <option value="cão"  <?php echo e(request('species') == 'cão' ? 'selected' : ''); ?>>Cão</option>
                                <option value="gato" <?php echo e(request('species') == 'gato' ? 'selected' : ''); ?>>Gato</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Sexo</label>
                            <select name="gender" class="form-select rounded-pill bg-light border-0 text-dark">
                                <option value="">Todos</option>
                                <option value="macho" <?php echo e(request('gender') == 'macho' ? 'selected' : ''); ?>>Macho</option>
                                <option value="fêmea" <?php echo e(request('gender') == 'fêmea' ? 'selected' : ''); ?>>Fêmea</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Porte</label>
                            <select name="size" class="form-select rounded-pill bg-light border-0 text-dark">
                                <option value="">Todos</option>
                                <option value="pequeno" <?php echo e(request('size') == 'pequeno' ? 'selected' : ''); ?>>Pequeno</option>
                                <option value="médio"   <?php echo e(request('size') == 'médio' ? 'selected' : ''); ?>>Médio</option>
                                <option value="grande"  <?php echo e(request('size') == 'grande' ? 'selected' : ''); ?>>Grande</option>
                            </select>
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2 shadow-sm">
                                APLICAR FILTROS
                            </button>
                            <a href="<?php echo e(route('animals')); ?>" class="btn btn-outline-secondary rounded-pill fw-bold py-2">
                                LIMPAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-lg-9">
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-xl-4 d-flex align-items-stretch">
                    
                    <div class="card h-100 w-100 border-0 shadow-sm card-animal hover-lift">
                        
                        
                        <div class="position-relative overflow-hidden animal-img-container">
                            <?php if($animal->photo_url): ?>
                                <img src="<?php echo e($animal->photo_url); ?>" class="card-img-top" alt="<?php echo e($animal->name); ?>">
                            <?php else: ?>
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-paw fa-3x text-muted opacity-25"></i>
                                </div>
                            <?php endif; ?>

                            
                            <?php if($animal->special_needs): ?>
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 shadow-sm px-3 py-2 rounded-pill fw-bold">
                                    <i class="fas fa-star me-1"></i> Especial
                                </span>
                            <?php endif; ?>
                            
                            
                            <div class="hover-overlay"></div>
                        </div>

                        
                        <div class="card-body p-0 d-flex flex-column text-center">
                            
                            
                            <div class="pt-4 pb-2 px-3">
                                <h4 class="card-title fw-bold text-primary mb-1 text-uppercase" style="letter-spacing: 1px;">
                                    <?php echo e($animal->name); ?>

                                </h4>
                                <small class="text-muted fw-bold"><?php echo e(ucfirst($animal->species)); ?></small>
                            </div>

                            
                            <div class="row g-0 py-3 mt-2 border-top border-bottom border-light-subtle w-100">
                                
                                
                                <div class="col-4 border-end border-light-subtle">
                                    <?php $genderIcon = $animal->gender === 'macho' ? 'mars' : 'venus'; ?>
                                    <div class="text-warning fs-5 mb-1"><i class="fas fa-<?php echo e($genderIcon); ?>"></i></div>
                                    <span class="small text-muted fw-bold text-uppercase"><?php echo e($animal->gender); ?></span>
                                </div>

                                
                                <div class="col-4 border-end border-light-subtle">
                                    <div class="text-warning fs-5 mb-1"><i class="far fa-calendar-alt"></i></div>
                                    <span class="small text-muted fw-bold text-uppercase"><?php echo e(ucfirst($animal->age ?? '-')); ?></span>
                                </div>

                                
                                <div class="col-4">
                                    <div class="text-warning fs-5 mb-1"><i class="fas fa-compress-arrows-alt"></i></div>
                                    <span class="small text-muted fw-bold text-uppercase"><?php echo e(ucfirst($animal->size ?? '-')); ?></span>
                                </div>
                            </div>

                            
                            <div class="p-4 mt-auto">
                                <a href="<?php echo e(route('animal.show', $animal->id)); ?>" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 shadow-sm stretched-link transition-btn">
                                    QUERO ADOTAR <i class="fas fa-heart ms-1"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                        <div class="mb-3 text-muted opacity-50">
                            <i class="fas fa-search fa-4x"></i>
                        </div>
                        <h4 class="text-dark fw-bold">Nenhum amigo encontrado</h4>
                        <p class="text-muted">Tente mudar os filtros para encontrar seu pet ideal.</p>
                        <a href="<?php echo e(route('animals')); ?>" class="btn btn-primary rounded-pill mt-2 px-4">
                            Limpar Filtros
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="mt-5 d-flex justify-content-center">
                <?php echo e($animals->withQueryString()->links()); ?>

            </div>
        </div>
    </div>
</div>

<style>
    /* ESTILIZAÇÃO ESPECÍFICA PARA ORGANIZAÇÃO DOS CARDS */
    
    .card-animal {
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        overflow: hidden;
    }

    .animal-img-container {
        height: 260px; /* Altura fixa para todas as imagens */
        background-color: #f8f9fa;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Garante que a foto preencha sem distorcer */
        transition: transform 0.5s ease;
    }

    /* Efeito Hover no Card Completo */
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15) !important; /* Sombra Azulada */
    }

    .hover-lift:hover .card-img-top {
        transform: scale(1.05);
    }

    /* Ajuste fino no botão */
    .transition-btn {
        transition: all 0.3s ease;
        border-width: 2px;
    }
    
    .hover-lift:hover .transition-btn {
        background-color: var(--saau-blue-primary);
        color: #fff;
        border-color: var(--saau-blue-primary);
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/animals.blade.php ENDPATH**/ ?>