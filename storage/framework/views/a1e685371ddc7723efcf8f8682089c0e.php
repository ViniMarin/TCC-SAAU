<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - SAAU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --saau-blue-primary: #0056b3;
            --saau-blue-dark: #004494;
            --saau-yellow: #F7C300;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Quicksand', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, var(--saau-blue-primary) 0%, var(--saau-blue-dark) 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
            border-bottom: 5px solid var(--saau-yellow);
        }
        .btn-primary {
            background-color: var(--saau-blue-primary);
            border-color: var(--saau-blue-primary);
            border-radius: 50px;
            padding: 10px;
            font-weight: 700;
        }
        .btn-primary:hover {
            background-color: var(--saau-blue-dark);
            border-color: var(--saau-blue-dark);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.15);
            border-color: var(--saau-blue-primary);
        }
    </style>
</head>
<body>

    <div class="login-card bg-white">
        <div class="login-header">
            <i class="fas fa-user-shield fa-3x mb-3 text-warning"></i>
            <h4 class="fw-bold mb-0">Acesso Restrito</h4>
            <small class="opacity-75">Painel Administrativo SAAU</small>
        </div>
        <div class="p-4 pt-5">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 small">
                    <i class="fas fa-exclamation-circle me-1"></i> <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-primary"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 rounded-end-3 bg-light" placeholder="admin@saau.com" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-primary"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 rounded-end-3 bg-light" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        ENTRAR
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="<?php echo e(route('home')); ?>" class="text-decoration-none small text-muted hover-text-primary">
                    <i class="fas fa-arrow-left me-1"></i> Voltar ao site
                </a>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\TCC\TCC-SAAU\resources\views/admin/login.blade.php ENDPATH**/ ?>