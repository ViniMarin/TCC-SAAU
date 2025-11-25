<?php $__env->startSection('title', 'Pedido de Adoção - SAAU'); ?>
<?php $__env->startSection('page-title', 'Pedido de Adoção'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">

    
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <a href="<?php echo e(route('admin.adoption-requests.index')); ?>" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                <i class="fas fa-arrow-left me-2"></i> Voltar para a lista
            </a>
            <h1 class="mb-1">Pedido de Adoção</h1>
            <p class="text-muted mb-0">Reveja o cadastro, acompanhe mensagens e atualize o status deste pedido.</p>
        </div>

        <?php
            $status = $adoptionRequest->status;
            $badgeClass = $status === 'aprovado'
                ? 'success'
                : ($status === 'rejeitado' ? 'danger' : 'warning');
        ?>

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
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-primary-subtle text-primary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-user"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Informações do adotante</h5>
                            <small class="text-muted">Dados principais para contato e análise.</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Nome completo</small>
                                <span class="fw-semibold">
                                    <?php echo e($adoptionRequest->adopter_name ?? 'Não informado'); ?>

                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Telefone</small>
                                <span class="fw-semibold">
                                    <?php echo e($adoptionRequest->adopter_phone ?? 'Não informado'); ?>

                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">E-mail</small>
                                <span class="fw-semibold">
                                    <?php echo e($adoptionRequest->adopter_email ?? 'Não informado'); ?>

                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100 bg-light-subtle">
                                <small class="text-muted text-uppercase d-block">Cidade / Estado</small>
                                <span class="fw-semibold">
                                    <?php echo e($adoptionRequest->city_state ?? 'Não informado'); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-success-subtle text-success rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-paw"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Animal solicitado</h5>
                            <small class="text-muted">Resumo do perfil do pet vinculado.</small>
                        </div>
                    </div>

                    <?php if($adoptionRequest->animal): ?>
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <?php if($adoptionRequest->animal->photo_url): ?>
                                <img src="<?php echo e($adoptionRequest->animal->photo_url); ?>"
                                     alt="<?php echo e($adoptionRequest->animal->name); ?>"
                                     class="rounded"
                                     style="width: 120px; height: 120px; object-fit: cover;">
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
                                    <?php
                                        $animalStatus = $adoptionRequest->animal->status ?? 'indefinido';
                                        $animalStatusClass = $animalStatus === 'disponivel'
                                            ? 'bg-success-subtle text-success'
                                            : 'bg-secondary-subtle text-secondary';
                                    ?>
                                    <span class="badge <?php echo e($animalStatusClass); ?>">
                                        <?php echo e(ucfirst($animalStatus)); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning mb-0">
                            Animal não encontrado ou removido.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($adoptionRequest->message): ?>
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="bg-info-subtle text-info rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-comment-dots"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Mensagem do adotante</h5>
                                <small class="text-muted">Contexto e expectativas sobre a adoção.</small>
                            </div>
                        </div>
                        <p class="mb-0"><?php echo e($adoptionRequest->message); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="bg-secondary-subtle text-secondary rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-sticky-note"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Observações internas</h5>
                            <small class="text-muted">Use para organizar o acompanhamento com a equipe.</small>
                        </div>
                    </div>
                    <p class="mb-0"><?php echo e($adoptionRequest->admin_notes ?: 'Nenhuma observação registrada.'); ?></p>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">

            
            <?php
                $statusTextClass = $status === 'aprovado'
                    ? 'text-success'
                    : ($status === 'rejeitado' ? 'text-danger' : 'text-warning');
            ?>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Resumo do pedido</h5>
                    <dl class="row mb-0 small">
                        <dt class="col-5 text-muted">Status atual</dt>
                        <dd class="col-7 fw-semibold <?php echo e($statusTextClass); ?>">
                            <?php echo e(ucfirst($status)); ?>

                        </dd>

                        <dt class="col-5 text-muted mt-2">Data de recebimento</dt>
                        <dd class="col-7 mt-2">
                            <?php echo e($adoptionRequest->created_at->format('d/m/Y')); ?>

                        </dd>

                        <?php if($adoptionRequest->animal): ?>
                            <dt class="col-5 text-muted mt-2">Animal</dt>
                            <dd class="col-7 mt-2">
                                <?php echo e($adoptionRequest->animal->name); ?>

                            </dd>
                        <?php endif; ?>

                        <dt class="col-5 text-muted mt-2">Adotante</dt>
                        <dd class="col-7 mt-2">
                            <?php echo e($adoptionRequest->adopter_name ?? 'Não informado'); ?>

                        </dd>
                    </dl>
                </div>
            </div>

            
            <?php if($status === 'pendente'): ?>
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Atualizar andamento</h5>
                                <small class="text-muted">Defina se o pedido será aprovado ou rejeitado.</small>
                            </div>
                        </div>

                        <form action="<?php echo e(route('admin.adoption-requests.update', $adoptionRequest)); ?>" method="POST" class="vstack gap-3">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div>
                                <label for="status" class="form-label fw-semibold">Nova situação</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="aprovado">Aprovar pedido</option>
                                    <option value="rejeitado">Rejeitar pedido</option>
                                </select>
                                <small class="text-muted d-block mt-1">
                                    Após definir como Aprovado ou Rejeitado, novas alterações devem ser feitas pela tela de <strong>Editar</strong>.
                                </small>
                            </div>

                            <div>
                                <label for="admin_notes" class="form-label fw-semibold">Observações</label>
                                <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="Ex.: Motivo da aprovação ou pontos de atenção"><?php echo e($adoptionRequest->admin_notes); ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i> Salvar alterações
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <span class="bg-warning-subtle text-warning rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="fas fa-lock"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">Andamento já definido</h5>
                                <small class="text-muted">
                                    Este pedido está <strong><?php echo e(ucfirst($status)); ?></strong>.  
                                    Para alterar o status ou as observações, utilize o botão <strong>Editar</strong> na lista de pedidos.
                                </small>
                            </div>
                        </div>

                        <a href="<?php echo e(route('admin.adoption-requests.edit', $adoptionRequest)); ?>" class="btn btn-outline-primary w-100 mt-3">
                            <i class="fas fa-edit me-1"></i> Ir para edição do pedido
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="card shadow-sm border-0 bg-light-subtle">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="bg-danger-subtle text-danger rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="fas fa-trash"></i>
                        </span>
                        <div>
                            <h5 class="mb-0">Excluir pedido</h5>
                            <small class="text-muted">Remove definitivamente este registro.</small>
                        </div>
                    </div>

                    <form action="<?php echo e(route('admin.adoption-requests.destroy', $adoptionRequest)); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/adoption-requests/show.blade.php ENDPATH**/ ?>