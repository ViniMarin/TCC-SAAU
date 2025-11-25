<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="<?php echo e(route('admin.raffles.index')); ?>" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1"><?php echo e($raffle->title); ?></h1>
            <p class="text-muted mb-0">Painel de acompanhamento da rifa.</p>
        </div>
        <?php echo $__env->make('admin.partials.action-buttons', [
            'edit' => route('admin.raffles.edit', $raffle),
            'delete' => route('admin.raffles.destroy', $raffle),
            'deleteMessage' => 'Tem certeza que deseja remover esta rifa?'
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3 text-center">
                <div class="card-body">
                    <?php if($raffle->image_url): ?>
                    <img src="<?php echo e($raffle->image_url); ?>" alt="<?php echo e($raffle->title); ?>" class="img-fluid rounded mb-3" style="max-height: 240px; object-fit: cover;">
                    <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 240px;">
                        <i class="fas fa-ticket-alt fa-3x text-muted"></i>
                    </div>
                    <?php endif; ?>
                    <div class="d-grid gap-2 text-start">
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-<?php echo e($raffle->status === 'ativa' ? 'success-subtle text-success' : ($raffle->status === 'pausada' ? 'warning-subtle text-warning' : 'secondary-subtle text-secondary')); ?> rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-flag"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Status</small>
                                <div class="fw-semibold mb-0"><?php echo e(ucfirst($raffle->status)); ?></div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-day"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Data do sorteio</small>
                                <div class="fw-semibold mb-0"><?php echo e(\Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Criada em</small>
                            <div class="fw-semibold"><?php echo e($raffle->created_at?->format('d/m/Y H:i')); ?></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                            <div class="fw-semibold"><?php echo e($raffle->updated_at?->format('d/m/Y H:i')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-2 mb-1">
                                <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-gift"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Prêmio</small>
                                    <h5 class="mb-0"><?php echo e($raffle->prize ?: '-'); ?></h5>
                                </div>
                            </div>
                            <p class="text-muted mb-0 small">O que o ganhador leva para casa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-2 mb-1">
                                <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-ticket-alt"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Bilhetes</small>
                                    <h5 class="mb-0"><?php echo e($raffle->total_tickets); ?></h5>
                                </div>
                            </div>
                            <p class="text-muted mb-0 small">Capacidade máxima planejada.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3">
                        <div class="border rounded-3 p-3 bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-money-bill-wave"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Valor do bilhete</small>
                                    <div class="fw-semibold mb-0">R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?></div>
                                </div>
                            </div>
                            <p class="text-muted mb-0 small">Preço por número vendido.</p>
                        </div>
                        <div class="border rounded-3 p-3 bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-day"></i></span>
                                <div>
                                    <small class="text-uppercase text-muted fw-semibold">Data do sorteio</small>
                                    <div class="fw-semibold mb-0"><?php echo e(\Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y')); ?></div>
                                </div>
                            </div>
                            <p class="text-muted mb-0 small">Organize a divulgação e entrega.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-align-left"></i></span>
                        <div>
                            <h6 class="mb-0">Descrição</h6>
                            <small class="text-muted">Histórico e detalhes da rifa.</small>
                        </div>
                    </div>
                    <p class="mb-0"><?php echo nl2br(e($raffle->description ?? 'Nenhuma descrição informada.')); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\TCC\TCC-SAAU\resources\views/admin/raffles/show.blade.php ENDPATH**/ ?>