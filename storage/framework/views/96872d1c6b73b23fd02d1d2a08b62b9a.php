<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalhes do Pedido de Adoção</h1>
        <a href="<?php echo e(route('admin.adoption-requests.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Informações do Adotante</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> <?php echo e($adoptionRequest->adopter_name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($adoptionRequest->adopter_email); ?></p>
                    <p><strong>Telefone:</strong> <?php echo e($adoptionRequest->adopter_phone); ?></p>
                    <p><strong>Endereço:</strong> <?php echo e($adoptionRequest->adopter_address ?? 'Não informado'); ?></p>
                    <p><strong>Data do Pedido:</strong> <?php echo e($adoptionRequest->created_at->format('d/m/Y H:i')); ?></p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5>Informações do Animal</h5>
                </div>
                <div class="card-body">
                    <?php if($adoptionRequest->animal): ?>
                    <div class="d-flex align-items-center">
                        <?php if($adoptionRequest->animal->photo_url): ?>
                        <img src="<?php echo e($adoptionRequest->animal->photo_url); ?>" alt="<?php echo e($adoptionRequest->animal->name); ?>" 
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; margin-right: 20px;">
                        <?php endif; ?>
                        <div>
                            <h5><?php echo e($adoptionRequest->animal->name); ?></h5>
                            <p class="mb-1"><strong>Espécie:</strong> <?php echo e(ucfirst($adoptionRequest->animal->species)); ?></p>
                            <p class="mb-1"><strong>Raça:</strong> <?php echo e($adoptionRequest->animal->breed ?? 'N/A'); ?></p>
                            <p class="mb-1"><strong>Idade:</strong> <?php echo e($adoptionRequest->animal->age ?? 'N/A'); ?></p>
                            <p class="mb-1"><strong>Status:</strong> 
                                <span class="badge bg-<?php echo e($adoptionRequest->animal->status == 'disponivel' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($adoptionRequest->animal->status)); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <?php else: ?>
                    <p>Animal não encontrado</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($adoptionRequest->message): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Mensagem do Adotante</h5>
                </div>
                <div class="card-body">
                    <p><?php echo e($adoptionRequest->message); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($adoptionRequest->admin_notes): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Observações do Administrador</h5>
                </div>
                <div class="card-body">
                    <p><?php echo e($adoptionRequest->admin_notes); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Ações</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.adoption-requests.update', $adoptionRequest)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pendente" <?php echo e($adoptionRequest->status == 'pendente' ? 'selected' : ''); ?>>Pendente</option>
                                <option value="aprovado" <?php echo e($adoptionRequest->status == 'aprovado' ? 'selected' : ''); ?>>Aprovado</option>
                                <option value="rejeitado" <?php echo e($adoptionRequest->status == 'rejeitado' ? 'selected' : ''); ?>>Rejeitado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">Observações</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4"><?php echo e($adoptionRequest->admin_notes); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </form>

                    <hr>

                    <form action="<?php echo e(route('admin.adoption-requests.destroy', $adoptionRequest)); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este pedido?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Remover Pedido
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/admin/adoption-requests/show.blade.php ENDPATH**/ ?>