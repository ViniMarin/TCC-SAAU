@extends('layouts.app')

@section('title', 'Login - SAAU')

{{-- TÍTULO NA FAIXA AZUL --}}
@section('header-content')
    <h1 class="page-header-title">LOGIN</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 20px; overflow: hidden;">
                <div class="card-body">
                    
                    {{-- Ícone de Usuário no Topo do Card --}}
                    <div class="text-center mb-4 mt-2">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Bem-vindo de volta!</h4>
                        <p class="text-muted small">Aceda à sua conta para continuar.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Campo Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-muted text-uppercase">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 rounded-end-pill bg-light py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="seu@email.com">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block mt-1 small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Campo Senha --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label small fw-bold text-muted text-uppercase">Senha</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small text-warning fw-bold hover-text-primary" href="{{ route('password.request') }}">
                                        Esqueceu a senha?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password" type="password" class="form-control border-start-0 rounded-end-pill bg-light py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block mt-1 small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Checkbox Lembrar --}}
                        <div class="mb-4 form-check ms-1">
                            <input class="form-check-input border-primary" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted fw-bold" for="remember">
                                Manter conectado
                            </label>
                        </div>

                        {{-- Botão Entrar --}}
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold shadow-sm btn-lg">
                                ENTRAR <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>
                        </div>

                        {{-- Link Cadastro --}}
                        <div class="text-center border-top pt-3 border-light-subtle">
                            <p class="small text-muted mb-1">Não tem uma conta?</p>
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary hover-text-warning transition-colors">
                                Crie a sua conta agora <i class="fas fa-arrow-right small ms-1"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Remove a borda de foco padrão do bootstrap para ficar mais clean e azul */
    .form-control:focus, .form-check-input:focus {
        box-shadow: none;
        border-color: var(--saau-blue-primary);
    }
    
    /* Cor do checkbox quando marcado */
    .form-check-input:checked {
        background-color: var(--saau-blue-primary);
        border-color: var(--saau-blue-primary);
    }

    .input-group-text {
        border-color: #dee2e6;
    }
    
    /* Ajuste para unir o ícone com o input visualmente */
    .form-control {
        border-left: none;
    }
    
    .input-group:focus-within .input-group-text {
        border-color: var(--saau-blue-primary);
        background-color: #fff;
    }
    .input-group:focus-within .form-control {
        border-color: var(--saau-blue-primary);
        background-color: #fff;
    }

    /* Efeitos de hover customizados */
    .hover-text-primary:hover {
        color: var(--saau-blue-primary) !important;
    }
    .hover-text-warning:hover {
        color: var(--saau-yellow) !important;
    }
    .transition-colors {
        transition: color 0.3s ease;
    }
</style>
@endsection