<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gerenciar Rifas</h1>
        <a href="<?php echo e(route('admin.raffles.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Criar Nova Rifa
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Prêmio</th>
                            <th>Valor do Bilhete</th>
                            <th>Total de Bilhetes</th>
                            <th>Data do Sorteio</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $raffles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raffle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($raffle->image_url): ?>
                                <img src="<?php echo e($raffle->image_url); ?>" alt="<?php echo e($raffle->title); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                <div style="width: 50px; height: 50px; background: #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($raffle->title); ?></td>
                            <td><?php echo e($raffle->prize ?? '-'); ?></td>
                            <td>R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?></td>
                            <td><?php echo e($raffle->total_tickets); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y')); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($raffle->status == 'ativa' ? 'success' : ($raffle->status == 'sorteada' ? 'info' : 'secondary')); ?>">
                                    <?php echo e(ucfirst($raffle->status)); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.raffles.edit', $raffle)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.raffles.destroy', $raffle)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta rifa?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">Nenhuma rifa cadastrada.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($raffles->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/raffles/index.blade.php ENDPATH**/ ?>