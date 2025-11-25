<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SAAU - Sociedade de Amparo aos Animais de Umuarama'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* --- PALETA DE CORES --- */
            --saau-blue-primary: #0056b3;
            --saau-blue-dark: #004494;
            --saau-yellow: #F7C300; /* Amarelo Ouro para detalhes */
            
            --saau-light: #F8F9FA;
            --saau-dark: #2C3E50;
        }

        html, body { 
            height: 100%; 
            margin: 0;
            font-family: 'Quicksand', sans-serif; 
            color: #4a4a4a;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f4f6f9; /* Fundo levemente cinza */
        }

        #main-content {
            flex: 1 0 auto;
        }

        /* --- SOBRESCEVENDO BOOTSTRAP --- */
        .text-primary { color: var(--saau-blue-primary) !important; }
        .bg-primary { background-color: var(--saau-blue-primary) !important; }
        .border-primary { border-color: var(--saau-blue-primary) !important; }
        .text-warning { color: var(--saau-yellow) !important; }
        
        .btn-primary {
            background-color: var(--saau-blue-primary) !important;
            border-color: var(--saau-blue-primary) !important;
            color: white !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 25px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--saau-blue-dark) !important;
            border-color: var(--saau-blue-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 86, 179, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--saau-blue-primary) !important;
            border-color: var(--saau-blue-primary) !important;
            font-weight: 700;
            border-radius: 50px;
        }
        .btn-outline-primary:hover {
            background-color: var(--saau-blue-primary) !important;
            color: white !important;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: #ffffff !important;
            /* CORREÇÃO 1: Linha superior amarela */
            border-top: 5px solid var(--saau-yellow); 
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); 
            padding-top: 15px;
            padding-bottom: 15px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--saau-dark) !important;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }
        
        /* CORREÇÃO 2: Logo Amarelo (rgb(249, 168, 112) foi removido em favor do padrão amarelo) */
        .navbar-brand i {
            color: var(--saau-yellow) !important; 
            font-size: 2rem;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: var(--saau-dark);
            font-weight: 700;
            font-size: 0.95rem;
            padding: 8px 18px !important;
            transition: all 0.3s ease;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--saau-blue-primary) !important;
            background-color: rgba(0, 86, 179, 0.08);
        }

        /* Botão Entrar Fixo */
        .btn-login-fixed {
            background-color: var(--saau-blue-primary) !important;
            border-color: var(--saau-blue-primary) !important;
            color: #ffffff !important;
            opacity: 1 !important;
            box-shadow: 0 4px 6px rgba(0, 86, 179, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            font-weight: 700 !important;
        }
        
        .btn-login-fixed:hover {
            background-color: var(--saau-blue-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 86, 179, 0.4);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-radius: 15px;
            margin-top: 10px;
            border-top: 4px solid var(--saau-blue-primary);
        }

        /* --- FAIXA DE TÍTULO (AZUL) --- */
        .page-header-strip {
            background: linear-gradient(135deg, var(--saau-blue-primary) 0%, var(--saau-blue-dark) 100%);
            width: 100%;
            min-height: 220px; 
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 10;
        }

        .page-header-title {
            color: #ffffff;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            font-size: 3.5rem;
            text-align: center;
            text-shadow: 0 4px 10px rgba(0,0,0,0.2); 
        }

        .banner-area { position: relative; z-index: 5; }

        /* --- FOOTER (AZUL COM LINHA AMARELA) --- */
        footer { 
            flex-shrink: 0;
            background-color: var(--saau-blue-primary); 
            color: white; 
            padding: 70px 0 30px 0; 
            margin-top: auto;
            border-top-left-radius: 60px;
            border-top-right-radius: 60px;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.05);
            position: relative;
            background: linear-gradient(to bottom, var(--saau-blue-primary), var(--saau-blue-dark));
            
            /* CORREÇÃO 3: Linha superior do footer amarela */
            border-top: 5px solid var(--saau-yellow);
        }

        footer a { color: rgba(255,255,255, 0.85); transition: all 0.2s; }
        footer a:hover { color: var(--saau-yellow); padding-left: 5px; text-decoration: none; }
        
        .social-btn {
            width: 42px; height: 42px; 
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3); 
            color: white;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 50%; transition: all 0.3s; font-size: 1.2rem;
        }
        .social-btn:hover {
            background-color: white; 
            color: var(--saau-blue-primary);
            transform: translateY(-3px) scale(1.1);
            border-color: white;
        }
        
        @media (max-width: 768px) {
            .page-header-title { font-size: 2.2rem; }
            .page-header-strip { min-height: 150px; }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-paw"></i> SAAU
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('animals')); ?>">Adotar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('events')); ?>">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('raffles')); ?>">Rifas</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Mais</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo e(route('stories.index')); ?>">Histórias</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('how-it-works')); ?>">Como Funciona</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('how-to-help')); ?>">Como Ajudar</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('faq')); ?>">FAQ</a></li>
                        </ul>
                    </li>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'veterinario'): ?>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle btn btn-outline-dark px-3 rounded-pill" href="#" role="button" data-bs-toggle="dropdown" style="border: 1px solid var(--saau-dark);">
                                <i class="fas fa-user-shield me-1"></i> <?php echo e(auth()->user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">Painel Administrativo</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle btn btn-primary text-white px-3 shadow-sm rounded-pill" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> <?php echo e(auth()->user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo e(route('animals')); ?>">Quero adotar</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('adoption-stories.create')); ?>">Enviar história</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-login-fixed px-4 rounded-pill" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-paw me-1"></i> ENTRAR
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header-strip">
        <div class="container">
            <?php echo $__env->yieldContent('header-content'); ?>
        </div>
    </div>

    <div class="banner-area">
        <?php echo $__env->yieldContent('banner'); ?>
    </div>

    <div id="main-content" class="py-5">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer>
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4 col-md-6 mb-4 pe-lg-5">
                    <h4 class="text-white mb-3 fw-bold"><i class="fas fa-paw me-2 text-warning"></i> SAAU</h4>
                    <p class="text-white opacity-90" style="line-height: 1.7; font-size: 0.95rem;">
                        A Sociedade de Amparo aos Animais de Umuarama é uma organização dedicada a resgatar, cuidar e encontrar lares amorosos para animais abandonados em nossa região.
                    </p>
                    <div class="mt-4">
                        <a href="https://facebook.com" target="_blank" class="social-btn me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com" target="_blank" class="social-btn me-2"><i class="fab fa-instagram"></i></a>
                        <a href="https://whatsapp.com" target="_blank" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white mb-3 fw-bold text-uppercase small" style="letter-spacing: 1px; opacity: 0.8;">Acesso Rápido</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>Início</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('animals')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>Quero Adotar</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('how-to-help')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>Como Ajudar</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('events')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>Eventos</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('stories.index')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>Histórias de Sucesso</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('faq')); ?>" class="text-decoration-none"><i class="fas fa-chevron-right small me-2 opacity-50"></i>FAQ</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-12 mb-4">
                    <h5 class="text-white mb-3 fw-bold text-uppercase small" style="letter-spacing: 1px; opacity: 0.8;">Fale Conosco</h5>
                    <ul class="list-unstyled text-white opacity-90">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt mt-1 me-3 fs-5 opacity-75 text-warning"></i>
                            <span style="font-size: 0.95rem;">Rodovia PR-482, Km 3 (Saída para Maria Helena)<br>Umuarama - PR, 87500-000</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone-alt me-3 fs-5 opacity-75 text-warning"></i>
                            <span style="font-size: 0.95rem;">(44) 98432-8357</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-3 fs-5 opacity-75 text-warning"></i>
                            <span style="font-size: 0.95rem;">saau.umuarama@gmail.com</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-clock me-3 fs-5 opacity-75 text-warning"></i>
                            <span style="font-size: 0.95rem;">Seg - Sex: 08h às 17h | Sáb: 08h às 12h</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-white opacity-25">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <small class="opacity-75">&copy; <?php echo e(date('Y')); ?> SAAU. Todos os direitos reservados.</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white text-decoration-none small me-3 opacity-75 hover-white">Termos de Uso</a>
                    <a href="#" class="text-white text-decoration-none small opacity-75 hover-white">Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\eutei\OneDrive\Área de Trabalho\TCC-SAAU\resources\views/layouts/app.blade.php ENDPATH**/ ?>