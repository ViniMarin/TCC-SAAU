<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Eventos</h1>
        <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Novo Evento
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Local</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($event->image_url): ?>
                                <img src="<?php echo e($event->image_url); ?>" alt="<?php echo e($event->title); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($event->title); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($event->date)->format('d/m/Y')); ?></td>
                            <td><?php echo e($event->location ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($event->active ? 'success' : 'secondary'); ?>">
                                    <?php echo e($event->active ? 'Ativo' : 'Inativo'); ?>

                                </span>
                            </td>
                            <td>
                                <?php echo $__env->make('admin.partials.action-buttons', [
                                    'view' => route('admin.events.show', $event),
                                    'edit' => route('admin.events.edit', $event),
                                    'delete' => route('admin.events.destroy', $event),
                                    'deleteMessage' => 'Tem certeza que deseja remover este evento?'
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum evento cadastrado.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($events->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/admin/events/index.blade.php ENDPATH**/ ?>