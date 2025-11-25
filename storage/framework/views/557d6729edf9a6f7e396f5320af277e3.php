<?php $__env->startSection('title', 'Compartilhar História - SAAU'); ?>


<?php $__env->startSection('header-content'); ?>
    <h1 class="page-header-title">COMPARTILHE SUA HISTÓRIA</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-heart fa-3x text-warning"></i>
                        </div>
                        <h3 class="fw-bold text-primary">Conte-nos como foi!</h3>
                        <p class="text-muted">Sua experiência pode inspirar outras pessoas a adotar um amigo. Preencha os dados abaixo e compartilhe sua alegria.</p>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4">
                            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                            <ul class="mb-0 small">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('stories.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Adotante</label>
                            <input type="text" class="form-control rounded-pill bg-light border-0 py-2 text-muted" value="<?php echo e(auth()->user()->name ?? 'Usuário'); ?>" disabled>
                            <div class="form-text ms-2 small"><i class="fas fa-info-circle text-primary me-1"></i> Usaremos o nome da sua conta para a publicação.</div>
                        </div>

                        <div class="row mb-4">
                            
                            <div class="col-md-6">
                                <label for="animal_name" class="form-label small fw-bold text-muted text-uppercase">Nome do Animal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill bg-white border py-2 <?php $__errorArgs = ['animal_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="animal_name" name="animal_name" placeholder="Ex: Rex" value="<?php echo e(old('animal_name')); ?>" required>
                            </div>
                            
                            
                            
                            
                            
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="title" class="form-label small fw-bold text-muted text-uppercase">Título (Opcional)</label>
                                <input type="text" class="form-control rounded-pill bg-white border py-2" id="title" name="title" placeholder="Ex: Um final feliz" value="<?php echo e(old('title')); ?>">
                            </div>
                        </div>

                        
                        <div class="mb-4">
                            <label for="story" class="form-label small fw-bold text-muted text-uppercase">Sua História <span class="text-danger">*</span></label>
                            <textarea class="form-control bg-white border p-3 <?php $__errorArgs = ['story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="story" name="story" rows="6" placeholder="Conte como foi o processo de adoção, adaptação e momentos especiais..." style="border-radius: 15px;" required><?php echo e(old('story')); ?></textarea>
                        </div>

                        
                        
                        

                        
                        <div class="mb-5">
                            <label for="photo" class="form-label small fw-bold text-muted text-uppercase">Foto do Pet (Opcional)</label>
                            <div class="input-group">
                                <input type="file" class="form-control rounded-pill bg-light border-0" id="photo" name="photo" accept="image/*">
                                <label class="input-group-text rounded-end-pill bg-primary text-white border-primary" for="photo">
                                    <i class="fas fa-upload me-2"></i> Escolher
                                </label>
                            </div>
                            <div class="form-text small text-muted ms-2 mt-1">
                                <i class="fas fa-camera me-1 text-warning"></i> A imagem será exibida após aprovação.
                            </div>
                        </div>

                        
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end align-items-center">
                            <a href="<?php echo e(route('stories.index')); ?>" class="btn btn-link text-muted text-decoration-none fw-bold px-4">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm transition-btn">
                                <i class="fas fa-paper-plane me-2"></i> ENVIAR HISTÓRIA
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
        border-color: var(--saau-blue-primary);
    }
    .transition-btn {
        transition: all 0.3s ease;
    }
    .transition-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 86, 179, 0.2) !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/public/story-create.blade.php ENDPATH**/ ?>