<?php $__env->startSection('title', $animal->name . ' para adoção - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title"><?php echo e($animal->name); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <?php if($animal->photo_url): ?>
                    <div class="ratio ratio-4x3">
                        <img
                            src="<?php echo e($animal->photo_url); ?>"
                            class="w-100 h-100"
                            alt="<?php echo e($animal->name); ?>"
                            style="object-fit: cover;"
                        >
                    </div>
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 320px;">
                        <i class="fas fa-paw fa-4x text-muted opacity-50"></i>
                    </div>
                <?php endif; ?>

                <?php if($animal->status ?? false): ?>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span class="badge rounded-pill 
                            <?php if($animal->status === 'disponivel'): ?> bg-success
                            <?php elseif($animal->status === 'em_tratamento'): ?> bg-warning text-dark
                            <?php else: ?> bg-secondary
                            <?php endif; ?>
                        ">
                            <?php switch($animal->status):
                                case ('disponivel'): ?> Disponível <?php break; ?>
                                <?php case ('em_tratamento'): ?> Em tratamento <?php break; ?>
                                <?php case ('adotado'): ?> Adotado <?php break; ?>
                                <?php default: ?> <?php echo e(ucfirst($animal->status)); ?>

                            <?php endswitch; ?>
                        </span>

                        <?php if($animal->castrated || $animal->vaccinated || $animal->dewormed): ?>
                            <div class="d-flex gap-2 small text-muted">
                                <?php if($animal->castrated): ?>
                                    <span><i class="fas fa-check text-success me-1"></i>Castrado</span>
                                <?php endif; ?>
                                <?php if($animal->vaccinated): ?>
                                    <span><i class="fas fa-check text-success me-1"></i>Vacinado</span>
                                <?php endif; ?>
                                <?php if($animal->dewormed): ?>
                                    <span><i class="fas fa-check text-success me-1"></i>Vermifugado</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-lg-6 d-flex flex-column">
            
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="fas fa-info-circle me-2"></i>Informações do animal
                    </h5>

                    <div class="row g-2 small">
                        <div class="col-12">
                            <strong><i class="fas fa-paw me-2"></i>Espécie:</strong>
                            <?php echo e(ucfirst($animal->species)); ?>

                        </div>

                        <?php if($animal->breed): ?>
                            <div class="col-12">
                                <strong><i class="fas fa-dog me-2"></i>Raça:</strong>
                                <?php echo e($animal->breed); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($animal->age): ?>
                            <div class="col-12">
                                <strong><i class="fas fa-calendar me-2"></i>Idade:</strong>
                                <?php echo e($animal->age); ?>

                            </div>
                        <?php endif; ?>

                        <?php
                            $genderIcon  = $animal->gender === 'macho' ? 'mars' : 'venus';
                            $genderLabel = $animal->gender === 'macho' ? 'Macho' : 'Fêmea';
                        ?>
                        <div class="col-12">
                            <strong><i class="fas fa-<?php echo e($genderIcon); ?> me-2"></i>Sexo:</strong>
                            <?php echo e($genderLabel); ?>

                        </div>

                        <?php if($animal->size): ?>
                            <div class="col-12">
                                <strong><i class="fas fa-ruler me-2"></i>Porte:</strong>
                                <?php echo e(ucfirst($animal->size)); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($animal->color): ?>
                            <div class="col-12">
                                <strong><i class="fas fa-palette me-2"></i>Cor:</strong>
                                <?php echo e($animal->color); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($animal->special_needs): ?>
                            <div class="col-12 mt-2">
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Necessidades especiais
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <?php if($animal->description): ?>
                <div class="card border-0 shadow-sm rounded-4 mb-3 flex-grow-1">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-align-left me-2"></i>Sobre <?php echo e($animal->name); ?>

                        </h5>
                        <p class="mb-0 text-muted" style="line-height: 1.6;">
                            <?php echo e($animal->description); ?>

                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h3 class="fw-bold text-primary mb-3">
                        <i class="fas fa-heart me-2"></i>Solicitar adoção de <?php echo e($animal->name); ?>

                    </h3>

                    <?php if(auth()->guard()->check()): ?>
                        <p class="text-muted small mb-4">
                            Preencha os dados abaixo para que nossa equipe possa analisar seu pedido de adoção.
                        </p>

                        <form method="POST" action="<?php echo e(route('adoption.request', $animal->id)); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Nome completo</label>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        value="<?php echo e(auth()->user()->name); ?>"
                                        readonly
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">E-mail</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?php echo e(auth()->user()->email); ?>"
                                        readonly
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Telefone</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        placeholder="(xx) xxxxx-xxxx"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Cidade/Estado</label>
                                    <input
                                        type="text"
                                        name="city_state"
                                        class="form-control"
                                        placeholder="Cidade / UF"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Tipo de moradia</label>
                                    <select name="housing_type" class="form-select" required>
                                        <option value="">Selecione</option>
                                        <option value="casa">Casa</option>
                                        <option value="apartamento">Apartamento</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Mensagem</label>
                                    <textarea
                                        name="message"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Conte um pouco sobre você, sua rotina e por que deseja adotar <?php echo e($animal->name); ?>."
                                    ></textarea>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    Enviar pedido de adoção
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info d-flex align-items-center mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>
                                Para solicitar a adoção de <?php echo e($animal->name); ?>, faça
                                <a href="<?php echo e(route('login')); ?>" class="alert-link">login</a>
                                ou
                                <a href="<?php echo e(route('register')); ?>" class="alert-link">crie sua conta</a>.
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/animal-show.blade.php ENDPATH**/ ?>