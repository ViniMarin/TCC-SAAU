<?php $__env->startSection('title', 'Relatórios - Painel Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1 class="page-title mb-1">Relatórios</h1>
        <p class="text-muted mb-0">Exporte informações dos módulos do painel em PDF com filtros de data e tipo.</p>
    </div>
</div>

<div class="content-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h2 class="card-title mb-0"><i class="fas fa-file-export me-2"></i>Gerar Relatório</h2>
    </div>

    <?php
        $formatDateValue = function (?string $value) {
            if (!$value) {
                return '';
            }

            try {
                return \Carbon\Carbon::parse($value)->format('d/m/Y');
            } catch (Exception) {
                return $value;
            }
        };

        $startDateValue = $formatDateValue(old('start_date'));
        $endDateValue = $formatDateValue(old('end_date'));
    ?>

    <form action="<?php echo e(route('admin.reports.export')); ?>" method="GET" class="row g-3" target="_blank">
        <div class="col-md-6">
            <label for="type" class="form-label">Tipo de relatório</label>
            <select name="type" id="type" class="form-select" required>
                <option value="all">Completo (todos os módulos)</option>
                <option value="animals">Animais</option>
                <option value="vaccines">Vacinas</option>
                <option value="raffles">Rifas</option>
                <option value="events">Eventos</option>
                <option value="donations">Doações</option>
            </select>
            <small class="text-muted">Selecione "Completo" para incluir Animais, Vacinas, Rifas, Eventos e Doações.</small>
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Data inicial</label>
            <input type="text" name="start_date" id="start_date" class="form-control" inputmode="numeric" maxlength="10"
                   placeholder="DD/MM/AAAA" value="<?php echo e($startDateValue); ?>" />
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Data final</label>
            <input type="text" name="end_date" id="end_date" class="form-control" inputmode="numeric" maxlength="10"
                   placeholder="DD/MM/AAAA" value="<?php echo e($endDateValue); ?>" />
        </div>

        <div class="col-12 d-flex align-items-center justify-content-end gap-2">
            <button type="reset" class="btn btn-light">Limpar filtros</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-file-pdf me-1"></i>Exportar PDF</button>
        </div>
    </form>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Animais</h6>
            <p class="mb-2">Inclui identificação, espécie, porte, status e data de cadastro.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Vacinas</h6>
            <p class="mb-2">Animal, tipo de vacina, datas de aplicação e próxima dose.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Rifas</h6>
            <p class="mb-2">Título, prêmio, preço do bilhete, total de números e data do sorteio.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Eventos</h6>
            <p class="mb-2">Título, local, status de publicação e data do evento.</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="content-card h-100">
            <h6 class="text-uppercase text-muted">Doações</h6>
            <p class="mb-2">Data, valor, tipo e doador registrado.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    const maskDate = (input) => {
        const digits = input.value.replace(/\D/g, '').slice(0, 8);
        const parts = [];

        if (digits.length > 0) parts.push(digits.substring(0, Math.min(2, digits.length)));
        if (digits.length >= 3) parts.push(digits.substring(2, Math.min(4, digits.length)));
        if (digits.length >= 5) parts.push(digits.substring(4));

        input.value = parts.join('/');
    };

    const toISODate = (value) => {
        const match = value.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if (!match) return null;

        const [, day, month, year] = match;
        const isoDate = `${year}-${month}-${day}`;
        const parsed = new Date(isoDate);

        return Number.isNaN(parsed.getTime()) ? null : isoDate;
    };

    const validateDateInput = (input) => {
        if (!input.value.trim()) {
            input.setCustomValidity('');
            return '';
        }

        const isoDate = toISODate(input.value);
        if (!isoDate) {
            input.setCustomValidity('Use o formato DD/MM/AAAA.');
            return null;
        }

        input.setCustomValidity('');
        return isoDate;
    };

    const setupReportDates = () => {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');
        const form = startInput?.closest('form');

        if (!startInput || !endInput || !form) return;

        const ensureRangeValidity = (startIso, endIso) => {
            if (startIso && endIso && new Date(startIso) > new Date(endIso)) {
                endInput.setCustomValidity('A data final deve ser igual ou posterior à data inicial.');
                return false;
            }

            endInput.setCustomValidity('');
            return true;
        };

        const handleInput = (input) => maskDate(input);
        const handleBlur = (input) => {
            const isoDate = validateDateInput(input);
            if (isoDate === null) return;

            const startIso = validateDateInput(startInput);
            const endIso = validateDateInput(endInput);
            ensureRangeValidity(startIso, endIso);
        };

        [startInput, endInput].forEach((input) => {
            input.addEventListener('input', () => handleInput(input));
            input.addEventListener('blur', () => handleBlur(input));
        });

        form.addEventListener('submit', (event) => {
            const startIso = validateDateInput(startInput);
            const endIso = validateDateInput(endInput);

            if (startIso === null || endIso === null || !ensureRangeValidity(startIso, endIso)) {
                event.preventDefault();
                (endIso === null ? endInput : startInput).reportValidity();
                return;
            }

            startInput.value = startIso || '';
            endInput.value = endIso || '';
        });
    };

    document.addEventListener('DOMContentLoaded', setupReportDates);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\alterações do antonio\TCC-SAAU\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>