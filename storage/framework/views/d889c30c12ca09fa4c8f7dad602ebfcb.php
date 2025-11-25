<?php $__env->startSection('title', 'Como Funciona - SAAU'); ?>

<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">COMO FUNCIONA</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="fw-bold text-dark mb-3">O Processo de Adoção</h2>
            <p class="text-muted lead">Adotar um amigo é um ato de amor e responsabilidade. Veja como é simples trazer um novo membro para a sua família.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Passo 1 -->
        <div class="col-md-4 text-center">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 80px; height: 80px;">
                        <i class="fas fa-search fa-2x text-primary"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark">1. Escolha o seu Amigo</h4>
                <p class="text-muted">Navegue pela nossa página de <a href="<?php echo e(route('animals')); ?>" class="text-decoration-none fw-bold text-primary">Animais Disponíveis</a>. Utilize os filtros para encontrar o animal que combina com o seu estilo de vida.</p>
            </div>
        </div>

        <!-- Passo 2 -->
        <div class="col-md-4 text-center">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 80px; height: 80px;">
                        <i class="fas fa-file-signature fa-2x text-primary"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark">2. Manifeste Interesse</h4>
                <p class="text-muted">Clique em "Quero Adotar" no perfil do animal. Preencha o formulário de interesse ou entre em contacto connosco.</p>
            </div>
        </div>

        <!-- Passo 3 -->
        <div class="col-md-4 text-center">
            <div class="card h-100 border-0 shadow-sm p-4 hover-lift" style="border-radius: 20px;">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 80px; height: 80px;">
                        <i class="fas fa-home fa-2x text-primary"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark">3. Entrevista e Lar</h4>
                <p class="text-muted">Faremos uma breve entrevista e visita para garantir que o animal estará seguro. Se aprovado, leva o seu novo melhor amigo para casa!</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="<?php echo e(route('animals')); ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm text-white">
            <i class="fas fa-paw me-2"></i> Começar a Procurar
        </a>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s; }
    .hover-lift:hover { transform: translateY(-5px); }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/how-it-works.blade.php ENDPATH**/ ?>