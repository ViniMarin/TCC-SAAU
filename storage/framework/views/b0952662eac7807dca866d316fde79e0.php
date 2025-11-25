<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">Editar Usuário</h1>
</div>

<div class="content-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        
        <div></div>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" class="p-3">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text"
                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="name"
                   name="name"
                   value="<?php echo e(old('name', $user->name)); ?>"
                   required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email"
                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="email"
                   name="email"
                   value="<?php echo e(old('email', $user->email)); ?>"
                   required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha</label>
            <input type="password"
                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="password"
                   name="password"
                   autocomplete="new-password"
                   pattern="(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}"
                   title="A senha deve ter pelo menos 8 caracteres, com ao menos 1 letra maiúscula e 1 caractere especial.">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <small class="text-muted d-block mt-1">
                Deixe em branco para manter a senha atual.<br>
                A senha deve ter <strong>pelo menos 8 caracteres</strong>,
                com ao menos <strong>1 letra maiúscula</strong> e
                <strong>1 caractere especial</strong>.
            </small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Perfil *</label>
            <select class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="role"
                    name="role"
                    required>
                <option value="">Selecione...</option>
                <option value="admin" <?php echo e(old('role', $user->role) == 'admin' ? 'selected' : ''); ?>>Administrador</option>
                <option value="veterinario" <?php echo e(old('role', $user->role) == 'veterinario' ? 'selected' : ''); ?>>Veterinário</option>
                <option value="usuario" <?php echo e(old('role', $user->role) == 'usuario' ? 'selected' : ''); ?>>Usuário</option>
            </select>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Atualizar Usuário
            </button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>