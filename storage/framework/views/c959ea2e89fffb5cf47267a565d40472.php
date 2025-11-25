<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Evento: <?php echo e($event->title); ?></h1>
        <a href="<?php echo e(route('admin.events.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.events.update', $event)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="title" name="title" value="<?php echo e(old('title', $event->title)); ?>" required>
                    <?php $__errorArgs = ['title'];
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
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              id="description" name="description" rows="4"><?php echo e(old('description', $event->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

                <?php
                    $eventDateValue = old('date', $event->date?->format('Y-m-d'));
                    if ($eventDateValue) {
                        try {
                            $eventDateValue = \Carbon\Carbon::parse($eventDateValue)->format('d/m/Y');
                        } catch (Exception) {
                            $eventDateValue = $eventDateValue;
                        }
                    }

                    $startTimeValue = old('start_time', $event->start_time
                        ? \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i')
                        : ''
                    );
                ?>

                <div class="row">
                    
                    <div class="col-md-4 mb-3">
                        <label for="date" class="form-label">Data *</label>
                        <input type="text" inputmode="numeric" maxlength="10" placeholder="DD/MM/AAAA"
                               class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="date" name="date" value="<?php echo e($eventDateValue); ?>" required>
                        <?php $__errorArgs = ['date'];
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

                    
                    <div class="col-md-4 mb-3">
                        <label for="start_time" class="form-label">Horário de início *</label>
                        <input type="time"
                               id="start_time"
                               name="start_time"
                               class="form-control <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e($startTimeValue); ?>"
                               required>
                        <?php $__errorArgs = ['start_time'];
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

                    
                    <div class="col-md-4 mb-3">
                        <label for="location" class="form-label">Local</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="location" name="location" value="<?php echo e(old('location', $event->location)); ?>">
                        <?php $__errorArgs = ['location'];
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
                </div>

                <?php if($event->image_url): ?>
                <div class="mb-3">
                    <label class="form-label">Imagem Atual</label>
                    <div>
                        <img src="<?php echo e($event->image_url); ?>" alt="<?php echo e($event->title); ?>" style="max-width: 200px; border-radius: 8px;">
                    </div>
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="image" class="form-label"><?php echo e($event->image_url ? 'Alterar Imagem' : 'Adicionar Imagem'); ?></label>
                    <input type="file" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="image" name="image" accept="image/*">
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1" <?php echo e(old('active', $event->active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="active">
                        Evento Ativo
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    const maskEventDate = (input) => {
        const digits = input.value.replace(/\D/g, '').slice(0, 8);
        const parts = [];

        if (digits.length > 0) parts.push(digits.substring(0, Math.min(2, digits.length)));
        if (digits.length >= 3) parts.push(digits.substring(2, Math.min(4, digits.length)));
        if (digits.length >= 5) parts.push(digits.substring(4, digits.length));

        input.value = parts.join('/');
    };

    const toISODate = (value) => {
        const match = value.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if (!match) return null;
        const [, day, month, year] = match;
        const isoDate = `${year}-${month}-${day}`;
        const parsed = new Date(isoDate);
        return Number.isNaN(parsed.getTime()) ? null : isoDate;
    };

    const setupEventDate = () => {
        const dateInput = document.getElementById('date');
        if (!dateInput) return;

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const validateDate = () => {
            const isoDate = toISODate(dateInput.value);
            if (!isoDate) {
                dateInput.setCustomValidity('Use o formato DD/MM/AAAA.');
                return false;
            }

            const chosenDate = new Date(isoDate);
            if (chosenDate < today) {
                dateInput.setCustomValidity('A data deve ser igual ou posterior à data atual.');
                return false;
            }

            dateInput.setCustomValidity('');
            return isoDate;
        };

        dateInput.addEventListener('input', () => maskEventDate(dateInput));
        dateInput.addEventListener('blur', validateDate);

        const form = dateInput.closest('form');
        form?.addEventListener('submit', (event) => {
            const isoDate = validateDate();
            if (!isoDate) {
                event.preventDefault();
                dateInput.reportValidity();
                return;
            }

            dateInput.value = isoDate;
        });
    };

    document.addEventListener('DOMContentLoaded', () => {
        setupEventDate();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/events/edit.blade.php ENDPATH**/ ?>