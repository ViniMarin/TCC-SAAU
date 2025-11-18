<?php $__env->startSection('title', 'Dashboard - Painel Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="fas fa-paw"></i>
        </div>
        <div class="stat-label">Total de Animais</div>
        <div class="stat-value"><?php echo e($stats['total_animals']); ?></div>
    </div>
    
    <div class="stat-card green">
        <div class="stat-icon">
            <i class="fas fa-heart"></i>
        </div>
        <div class="stat-label">Animais Disponíveis</div>
        <div class="stat-value"><?php echo e($stats['available']); ?></div>
    </div>
    
    <div class="stat-card purple">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-label">Adoções Realizadas</div>
        <div class="stat-value"><?php echo e($stats['adopted']); ?></div>
    </div>
    
    <div class="stat-card orange">
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-label">Pedidos Pendentes</div>
        <div class="stat-value"><?php echo e($stats['pending_requests']); ?></div>
    </div>
    
    <div class="stat-card yellow">
        <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="stat-label">Total Doado</div>
        <div class="stat-value">R$ <?php echo e(number_format($stats['total_donations'], 2, ',', '.')); ?></div>
    </div>
    
    <div class="stat-card red">
        <div class="stat-icon">
            <i class="fas fa-syringe"></i>
        </div>
        <div class="stat-label">Vacinas Aplicadas</div>
        <div class="stat-value"><?php echo e($stats['total_vaccines']); ?></div>
    </div>
</div>

<!-- Recent Animals -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-paw me-2"></i>Animais Recentes</h2>
        <a href="<?php echo e(route('admin.animals.index')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-eye me-1"></i>Ver Todos
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recent_animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($animal->name); ?></strong></td>
                    <td><?php echo e(ucfirst($animal->species)); ?></td>
                    <td>
                        <?php if($animal->status === 'available' || $animal->status === 'disponivel'): ?>
                        <span class="badge bg-success">Disponível</span>
                        <?php elseif($animal->status === 'adopted' || $animal->status === 'adotado'): ?>
                        <span class="badge bg-primary">Adotado</span>
                        <?php else: ?>
                        <span class="badge bg-warning">Em Tratamento</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.animals.edit', $animal->id)); ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        <p>Nenhum animal cadastrado ainda.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Adoption Requests -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-clipboard-list me-2"></i>Pedidos de Adoção Recentes</h2>
        <a href="<?php echo e(route('admin.adoption-requests.index')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-eye me-1"></i>Ver Todos
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Adotante</th>
                    <th>Animal</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recent_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($request->adopter_name); ?></strong></td>
                    <td><?php echo e($request->animal->name ?? 'Animal não encontrado'); ?></td>
                    <td>
                        <?php if($request->status === 'pending' || $request->status === 'pendente'): ?>
                        <span class="badge bg-warning">Pendente</span>
                        <?php elseif($request->status === 'approved' || $request->status === 'aprovado'): ?>
                        <span class="badge bg-success">Aprovado</span>
                        <?php else: ?>
                        <span class="badge bg-danger">Rejeitado</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.adoption-requests.show', $request->id)); ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        <p>Nenhum pedido de adoção ainda.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Donations -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-dollar-sign me-2"></i>Doações Recentes</h2>
        <a href="<?php echo e(route('admin.donations.index')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-eye me-1"></i>Ver Todas
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Doador</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recent_donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($donation->donor_name ?? 'Anônimo'); ?></strong></td>
                    <td><?php echo e(\Carbon\Carbon::parse($donation->date)->format('d/m/Y')); ?></td>
                    <td><span class="text-success fw-bold">R$ <?php echo e(number_format($donation->amount, 2, ',', '.')); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        <p>Nenhuma doação registrada.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Marin\Downloads\saau-final-corrigido\saau-final\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>