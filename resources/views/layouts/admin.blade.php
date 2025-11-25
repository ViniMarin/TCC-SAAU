<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel Administrativo - SAAU')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* --- PALETA DE CORES (MESMA DO SITE PÚBLICO) --- */
            --saau-blue-primary: #0056b3;
            --saau-blue-dark: #004494;
            --saau-yellow: #F7C300;
            
            --saau-light: #F8F9FA;
            --saau-dark: #2C3E50;
            --saau-gray-bg: #f4f6f9;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--saau-gray-bg);
            color: var(--saau-dark);
            overflow-x: hidden;
        }

        /* --- SIDEBAR (MENU LATERAL) --- */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--saau-blue-primary) 0%, var(--saau-blue-dark) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar-brand i {
            color: var(--saau-yellow);
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .sidebar-link:hover, 
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--saau-yellow); /* Destaque Amarelo */
        }

        .sidebar-link i {
            width: 25px;
            margin-right: 10px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* --- CONTEÚDO PRINCIPAL --- */
        .main-content {
            margin-left: 260px; /* Mesma largura da sidebar */
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* --- TOPBAR (NAVBAR SUPERIOR) --- */
        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-top: 4px solid var(--saau-yellow); /* Linha Amarela no Topo */
        }

        .page-title h4 {
            margin: 0;
            font-weight: 700;
            color: var(--saau-blue-primary);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info span {
            font-weight: 700;
            color: var(--saau-dark);
            display: block;
            line-height: 1.2;
        }
        
        .user-info small {
            color: #6c757d;
            font-size: 0.8rem;
        }

        .btn-logout {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        
        .btn-logout:hover {
            background-color: #ffeaea;
        }

        /* --- CARDS DO DASHBOARD --- */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: none;
            height: 100%;
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .bg-blue-soft { background-color: rgba(0, 86, 179, 0.1); color: var(--saau-blue-primary); }
        .bg-yellow-soft { background-color: rgba(247, 195, 0, 0.15); color: #b88b00; }
        .bg-green-soft { background-color: rgba(40, 167, 69, 0.1); color: #28a745; }
        .bg-red-soft { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }

        /* --- BOTÕES E TABELAS --- */
        .btn-primary {
            background-color: var(--saau-blue-primary) !important;
            border-color: var(--saau-blue-primary) !important;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: var(--saau-blue-dark) !important;
        }

        .table {
            vertical-align: middle;
        }
        
        .table th {
            font-weight: 700;
            color: var(--saau-dark);
            border-top: none;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Responsividade */
        @media (max-width: 991px) {
            .sidebar { left: -260px; }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0; }
            .toggle-sidebar { display: block; cursor: pointer; font-size: 1.5rem; margin-right: 15px; }
        }
        
        @media (min-width: 992px) {
            .toggle-sidebar { display: none; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand" target="_blank">
                <i class="fas fa-paw"></i> SAAU ADMIN
            </a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            
            <li class="text-uppercase small fw-bold text-white-50 px-4 mt-3 mb-2">Gerenciamento</li>
            
            <li>
                <a href="{{ route('admin.animals.index') }}" class="sidebar-link {{ request()->routeIs('admin.animals.*') ? 'active' : '' }}">
                    <i class="fas fa-dog"></i> Animais
                </a>
            </li>
            <li>
                <a href="{{ route('admin.adoption-requests.index') }}" class="sidebar-link {{ request()->routeIs('admin.adoption-requests.*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> Pedidos de Adoção
                </a>
            </li>
            <li>
                <a href="{{ route('admin.vaccines.index') }}" class="sidebar-link {{ request()->routeIs('admin.vaccines.*') ? 'active' : '' }}">
                    <i class="fas fa-syringe"></i> Vacinas
                </a>
            </li>
            <li>
                <a href="{{ route('admin.stories.index') }}" class="sidebar-link {{ request()->routeIs('admin.stories.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open"></i> Histórias
                </a>
            </li>

            <li class="text-uppercase small fw-bold text-white-50 px-4 mt-3 mb-2">Eventos & Financeiro</li>

            <li>
                <a href="{{ route('admin.events.index') }}" class="sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Eventos
                </a>
            </li>
            <li>
                <a href="{{ route('admin.raffles.index') }}" class="sidebar-link {{ request()->routeIs('admin.raffles.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt"></i> Rifas
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}" class="sidebar-link {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-usd"></i> Doações
                </a>
            </li>

            <li class="text-uppercase small fw-bold text-white-50 px-4 mt-3 mb-2">Sistema</li>

            <li>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Usuários
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Relatórios
                </a>
            </li>
        </ul>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="main-content" id="content">
        
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <div class="toggle-sidebar" id="sidebarCollapse">
                    <i class="fas fa-bars text-primary"></i>
                </div>
                <div class="page-title">
                    <h4>@yield('page-title', 'Painel de Controle')</h4>
                </div>
            </div>

            <div class="user-profile">
                <div class="user-info text-end d-none d-md-block">
                    <span>{{ auth()->user()->name }}</span>
                    <small>{{ ucfirst(auth()->user()->role) }}</small>
                </div>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="userDropdown" data-bs-toggle="dropdown">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary border border-primary" style="width: 40px; height: 40px;">
                            <i class="fas fa-user"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow p-2" style="border-radius: 10px;">
                        <li>
                            <a class="dropdown-item rounded" href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-external-link-alt me-2 text-muted"></i> Ver Site
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item rounded text-danger fw-bold">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Conteúdo da Página -->
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script simples para toggle da sidebar em mobile
        document.getElementById('sidebarCollapse')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @yield('scripts')
</body>
</html>