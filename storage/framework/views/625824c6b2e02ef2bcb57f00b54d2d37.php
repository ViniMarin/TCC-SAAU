<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
    <style>
        * { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; }
        body { font-size: 12px; color: #1f2937; margin: 24px; }
        h1 { font-size: 22px; margin-bottom: 6px; color: #111827; }
        h2 { font-size: 16px; margin: 20px 0 8px; color: #111827; }
        p.meta { margin: 2px 0; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { border: 1px solid #e5e7eb; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; font-weight: bold; color: #111827; }
        .muted { color: #6b7280; }
        .section { page-break-inside: avoid; margin-bottom: 12px; }
    </style>
</head>
<body>
    <?php
        $periodo = 'Todos os registros';

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $periodo = $filters['start_date'] . ' a ' . $filters['end_date'];
        } elseif (!empty($filters['start_date'])) {
            $periodo = 'A partir de ' . $filters['start_date'];
        } elseif (!empty($filters['end_date'])) {
            $periodo = 'Até ' . $filters['end_date'];
        }
    ?>

    <h1>Relatório <?php echo e($filters['type'] === 'all' ? 'Completo' : ucfirst($filters['type'])); ?></h1>
    <p class="meta">Período: <?php echo e($periodo); ?></p>
    <p class="meta">Gerado em: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y H:i')); ?></p>

    <?php if($animals->count()): ?>
        <div class="section">
            <h2>Animais (<?php echo e($animals->count()); ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Raça</th>
                        <th>Status</th>
                        <th>Castrado</th>
                        <th>Vacinado</th>
                        <th>Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($animal->id); ?></td>
                            <td><?php echo e($animal->name); ?></td>
                            <td><?php echo e($animal->species); ?></td>
                            <td><?php echo e($animal->breed ?? '-'); ?></td>
                            <td><?php echo e($animal->status); ?></td>
                            <td><?php echo e($animal->castrated ? 'Sim' : 'Não'); ?></td>
                            <td><?php echo e($animal->vaccinated ? 'Sim' : 'Não'); ?></td>
                            <td><?php echo e(optional($animal->created_at)->format('d/m/Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php elseif($filters['type'] === 'all' || $filters['type'] === 'animals'): ?>
        <p class="muted">Nenhum animal encontrado no período selecionado.</p>
    <?php endif; ?>

    <?php if($vaccines->count()): ?>
        <div class="section">
            <h2>Vacinas (<?php echo e($vaccines->count()); ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Animal</th>
                        <th>Tipo</th>
                        <th>Aplicação</th>
                        <th>Próxima dose</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $vaccines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaccine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($vaccine->id); ?></td>
                            <td><?php echo e($vaccine->animal->name ?? 'N/A'); ?></td>
                            <td><?php echo e($vaccine->vaccine_type); ?></td>
                            <td><?php echo e(optional($vaccine->application_date)->format('d/m/Y')); ?></td>
                            <td><?php echo e($vaccine->next_dose_date ? optional($vaccine->next_dose_date)->format('d/m/Y') : '-'); ?></td>
                            <td><?php echo e($vaccine->notes ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php elseif($filters['type'] === 'all' || $filters['type'] === 'vaccines'): ?>
        <p class="muted">Nenhuma vacina encontrada no período selecionado.</p>
    <?php endif; ?>

    <?php if($raffles->count()): ?>
        <div class="section">
            <h2>Rifas (<?php echo e($raffles->count()); ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Prêmio</th>
                        <th>Valor do bilhete</th>
                        <th>Data do sorteio</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $raffles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raffle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($raffle->id); ?></td>
                            <td><?php echo e($raffle->title); ?></td>
                            <td><?php echo e($raffle->prize ?? '-'); ?></td>
                            <td>R$ <?php echo e(number_format((float) $raffle->ticket_price, 2, ',', '.')); ?></td>
                            <td><?php echo e(optional($raffle->draw_date)->format('d/m/Y')); ?></td>
                            <td><?php echo e($raffle->status); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php elseif($filters['type'] === 'all' || $filters['type'] === 'raffles'): ?>
        <p class="muted">Nenhuma rifa encontrada no período selecionado.</p>
    <?php endif; ?>

    <?php if($events->count()): ?>
        <div class="section">
            <h2>Eventos (<?php echo e($events->count()); ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($event->id); ?></td>
                            <td><?php echo e($event->title); ?></td>
                            <td><?php echo e(optional($event->date)->format('d/m/Y')); ?></td>
                            <td><?php echo e($event->location ?? '-'); ?></td>
                            <td><?php echo e($event->active ? 'Ativo' : 'Inativo'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php elseif($filters['type'] === 'all' || $filters['type'] === 'events'): ?>
        <p class="muted">Nenhum evento encontrado no período selecionado.</p>
    <?php endif; ?>

    <?php if($donations->count()): ?>
        <div class="section">
            <h2>Doações (<?php echo e($donations->count()); ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Doador</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($donation->id); ?></td>
                            <td><?php echo e(optional($donation->date)->format('d/m/Y')); ?></td>
                            <td>R$ <?php echo e(number_format((float) $donation->amount, 2, ',', '.')); ?></td>
                            <td><?php echo e($donation->type); ?></td>
                            <td><?php echo e($donation->donor_name ?? 'Anônimo'); ?></td>
                            <td><?php echo e($donation->description ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php elseif($filters['type'] === 'all' || $filters['type'] === 'donations'): ?>
        <p class="muted">Nenhuma doação encontrada no período selecionado.</p>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/admin/reports/pdf.blade.php ENDPATH**/ ?>