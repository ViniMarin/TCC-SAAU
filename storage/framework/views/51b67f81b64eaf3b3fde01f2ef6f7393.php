<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1 class="mb-4"><?php echo e($raffle->title); ?></h1>

            <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Detalhes da Rifa</h5>
                    <p class="card-text"><?php echo nl2br(e($raffle->description)); ?></p>
                    <hr>
                    <p><strong>Prêmio:</strong> <?php echo e($raffle->prize); ?></p>
                    <p><strong>Valor do Bilhete:</strong> R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?></p>
                    <p><strong>Data do Sorteio:</strong> <?php echo e(\Carbon\Carbon::parse($raffle->draw_date)->format('d/m/Y')); ?></p>
                    <p><strong>Total de Bilhetes:</strong> <?php echo e($raffle->total_tickets); ?></p>
                    <p><strong>Bilhetes Vendidos:</strong> <?php echo e($ticketsSold); ?></p>
                    <p><strong>Bilhetes Restantes:</strong> <?php echo e($raffle->total_tickets - $ticketsSold); ?></p>
                </div>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-ticket-alt"></i> Comprar Bilhetes</h5>
                    <?php if($raffle->total_tickets - $ticketsSold > 0): ?>
                        <form action="<?php echo e(route('raffle.buy', $raffle)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantos bilhetes deseja comprar?</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="<?php echo e($raffle->total_tickets - $ticketsSold); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-shopping-cart"></i> Comprar Bilhetes (R$ <?php echo e(number_format($raffle->ticket_price, 2, ',', '.')); ?> cada)
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-danger">Todos os bilhetes foram vendidos!</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(count($userTickets) > 0): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-list-ol"></i> Seus Bilhetes</h5>
                    <p>Você comprou os seguintes números:</p>
                    <div class="d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = $userTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-primary"><?php echo e($ticket); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-lock"></i> Você precisa estar logado para comprar bilhetes. <a href="<?php echo e(route('login')); ?>">Faça login aqui</a>.
            </div>
            <?php endif; ?>

            <div class="mt-5">
                <a href="<?php echo e(route('raffles')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar para Rifas</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\TCC\TCC-SAAU\resources\views/public/raffle-show.blade.php ENDPATH**/ ?>