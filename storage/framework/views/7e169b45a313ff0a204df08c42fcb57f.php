

<?php $__env->startSection('content'); ?>
<div class="container my-5">

    <?php
        $status = $adoptionRequest->status;
        $badgeClass = $status === 'aprovado'
            ? 'success'
            : ($status === 'rejeitado' ? 'danger' : 'warning');
    ?>

    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="<?php echo e(route('admin.adoption-requests.index')); ?>"
               class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Editar Pedido de Adoção</h1>
            <p class="text-muted mb-0">
                Altere o status e as observações internas deste pedido.
            </p>
        </div>

        <div class="text-end">
            <span class="badge rounded-pill bg-<?php echo e($badgeClass); ?> px-3 py-2 text-uppercase">
                <i class="fas fa-flag me-1"></i><?php echo e(ucfirst($status)); ?>

            </span>
            <p class="text-muted small mb-0 mt-2">
                Recebido em <?php echo e($adoptionRequest->created_at->format('d/m/Y H:i')); ?>

            </p>
        </div>
    </div>

    <div class="row g-4">

        
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Informações do adotante</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Nome completo</small>
                                <span class="fw-semibold"><?php echo e($adoptionRequest->adopter_name ?? 'Não informado'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Telefone</small>
                                <span class="fw-semibold"><?php echo e($adoptionRequest->adopter_phone ?? 'Não informado'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">E-mail</small>
                                <span class="fw-semibold"><?php echo e($adoptionRequest->adopter_email ?? 'Não informado'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Cidade / Estado</small>
                                <span class="fw-semibold"><?php echo e($adoptionRequest->city_state ?? 'Não informado'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($adoptionRequest->animal): ?>
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Animal solicitado</h5>

                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <?php if($adoptionRequest->animal->photo_url): ?>
                                <img src="<?php echo e($adoptionRequest->animal->photo_url); ?>"
                                     alt="<?php echo e($adoptionRequest->animal->name); ?>"
                                     class="rounded"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="flex-grow-1">
                                <h5 class="mb-1"><?php echo e($adoptionRequest->animal->name); ?></h5>
                                <div class="d-flex flex-wrap gap-2 small">
                                    <span class="badge bg-primary-subtle text-primary">
                                        <?php echo e(ucfirst($adoptionRequest->animal->species)); ?>

                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        <?php echo e($adoptionRequest->animal->breed ?? 'Raça não informada'); ?>

                                    </span>
                                    <span class="badge bg-info-subtle text-info">
                                        <?php echo e($adoptionRequest->animal->age ?? 'Idade não informada'); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Atualizar andamento</h5>

                    <form action="<?php echo e(route('admin.adoption-requests.update', $adoptionRequest)); ?>"
                          method="POST" class="vstack gap-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div>
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pendente"  <?php echo e($adoptionRequest->status == 'pendente'  ? 'selected' : ''); ?>>Pendente</option>
                                <option value="aprovado"  <?php echo e($adoptionRequest->status == 'aprovado'  ? 'selected' : ''); ?>>Aprovado</option>
                                <option value="rejeitado" <?php echo e($adoptionRequest->status == 'rejeitado' ? 'selected' : ''); ?>>Rejeitado</option>
                            </select>
                        </div>

                        <div>
                            <label for="admin_notes" class="form-label fw-semibold">Observações internas</label>
                            <textarea class="form-control"
                                      id="admin_notes"
                                      name="admin_notes"
                                      rows="4"
                                      placeholder="Ex.: Motivo da aprovação ou pontos de atenção"><?php echo e(old('admin_notes', $adoptionRequest->admin_notes)); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i> Salvar alterações
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0 bg-light-subtle">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Excluir pedido</h6>
                    <p class="text-muted small">
                        Remove definitivamente este registro do sistema.
                    </p>

                    <form action="<?php echo e(route('admin.adoption-requests.destroy', $adoptionRequest)); ?>"
                          method="POST"
                          onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-1"></i> Remover pedido
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/adoption-requests/edit.blade.php ENDPATH**/ ?>