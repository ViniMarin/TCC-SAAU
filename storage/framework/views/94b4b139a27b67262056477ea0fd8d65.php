<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="<?php echo e(route('admin.animals.index')); ?>" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1"><?php echo e($animal->name); ?></h1>
            <p class="text-muted mb-0">Visualize o perfil completo do animal.</p>
        </div>
        <?php echo $__env->make('admin.partials.action-buttons', [
            'edit' => route('admin.animals.edit', $animal),
            'delete' => route('admin.animals.destroy', $animal),
            'deleteMessage' => 'Tem certeza que deseja remover este animal?'
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <?php if($animal->photo_url): ?>
                    <img src="<?php echo e($animal->photo_url); ?>" alt="<?php echo e($animal->name); ?>" class="img-fluid rounded mb-3" style="max-height: 260px; object-fit: cover;">
                    <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light rounded mb-3" style="height: 260px;">
                        <i class="fas fa-paw fa-3x text-muted"></i>
                    </div>
                    <?php endif; ?>
                    <div class="d-grid gap-2 text-start">
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-<?php echo e($animal->status == 'disponivel' ? 'success-subtle text-success' : ($animal->status == 'adotado' ? 'info-subtle text-info' : 'warning-subtle text-warning')); ?> rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-flag"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Status</small>
                                <div class="fw-semibold mb-0"><?php echo e(ucfirst(str_replace('_', ' ', $animal->status))); ?></div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-dog"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Espécie</small>
                                <div class="fw-semibold mb-0"><?php echo e(ucfirst($animal->species)); ?></div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-venus-mars"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Sexo</small>
                                <div class="fw-semibold mb-0"><?php echo e($animal->gender === 'macho' ? 'Macho' : 'Fêmea'); ?></div>
                            </div>
                        </div>
                        <div class="border rounded-3 p-2 bg-light d-flex align-items-center gap-2">
                            <span class="bg-info-subtle text-info rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-birthday-cake"></i></span>
                            <div>
                                <small class="text-uppercase text-muted">Idade</small>
                                <div class="fw-semibold mb-0"><?php echo e(ucfirst($animal->age)); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-calendar-plus"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Cadastro</small>
                            <div class="fw-semibold mb-0"><?php echo e($animal->created_at?->format('d/m/Y H:i')); ?></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-history"></i></span>
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Última atualização</small>
                            <div class="fw-semibold mb-0"><?php echo e($animal->updated_at?->format('d/m/Y H:i')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-paw"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Espécie & raça</small>
                                        <div class="fw-semibold"><?php echo e(ucfirst($animal->species)); ?> <?php echo e($animal->breed ? '· ' . $animal->breed : ''); ?></div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0 small">Referência rápida para identificação.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-ruler-vertical"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Porte & cor</small>
                                        <div class="fw-semibold"><?php echo e(ucfirst($animal->size)); ?> <?php echo e($animal->color ? '· ' . $animal->color : ''); ?></div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0 small">Dimensões e aparência geral.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-venus-mars"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Sexo & idade</small>
                                        <div class="fw-semibold"><?php echo e($animal->gender === 'macho' ? 'Macho' : 'Fêmea'); ?> · <?php echo e(ucfirst($animal->age)); ?></div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0 small">Ajuda no match com adotantes.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-white">
                                <div class="d-flex align-items-start gap-2 mb-1">
                                    <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-notes-medical"></i></span>
                                    <div>
                                        <small class="text-uppercase text-muted fw-semibold">Saúde geral</small>
                                        <div class="fw-semibold"><?php echo e($animal->health_status ?? 'Sem observação'); ?></div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0 small">Quadro clínico mais recente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-heart"></i></span>
                        <div>
                            <h6 class="mb-0">Cuidados e procedimentos</h6>
                            <small class="text-muted">Status de vacinas, vermífugo e castração.</small>
                        </div>
                    </div>
                    <ul class="list-unstyled mb-0 small row row-cols-1 row-cols-md-2 g-2">
                        <li class="d-flex align-items-center col"><i class="fas fa-syringe text-success me-2"></i><span>Vacinas: <?php echo e($animal->vaccinated ? 'Em dia' : 'Pendente'); ?></span></li>
                        <li class="d-flex align-items-center col"><i class="fas fa-bug text-warning me-2"></i><span>Vermífugo: <?php echo e($animal->dewormed ? 'Aplicado' : 'Atenção'); ?></span></li>
                        <li class="d-flex align-items-center col"><i class="fas fa-cut text-info me-2"></i><span>Castração: <?php echo e($animal->castrated ? 'Sim' : 'Não'); ?></span></li>
                        <li class="d-flex align-items-center col"><i class="fas fa-star text-secondary me-2"></i><span>Necessidades especiais: <?php echo e($animal->special_needs ? 'Sim' : 'Não'); ?></span></li>
                    </ul>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-2 mb-2">
                                <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-align-left"></i></span>
                                <div>
                                    <h6 class="mb-0">Descrição</h6>
                                    <small class="text-muted">Breve perfil para apresentação.</small>
                                </div>
                            </div>
                            <p class="mb-0"><?php echo nl2br(e($animal->description ?? 'Nenhuma descrição informada.')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-2 mb-2">
                                <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fas fa-stethoscope"></i></span>
                                <div>
                                    <h6 class="mb-0">Observações de saúde</h6>
                                    <small class="text-muted">Notas médicas e de acompanhamento.</small>
                                </div>
                            </div>
                            <p class="mb-0"><?php echo nl2br(e($animal->health_notes ?? 'Nenhuma observação adicional.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/animals/show.blade.php ENDPATH**/ ?>