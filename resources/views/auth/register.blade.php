@extends('layouts.app')

@section('title', 'Criar conta - SAAU')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-lg-5">

                    {{-- Ícone / título --}}
                    <div class="text-center mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width:72px;height:72px;background:#f2f5ff;">
                            <i class="fas fa-user text-primary fs-2"></i>
                        </div>
                        <h1 class="h4 fw-bold mb-1">Criar conta</h1>
                        <p class="text-muted small mb-0">
                            Cadastre-se para acompanhar adoções, eventos e rifas.
                        </p>
                    </div>

                    {{-- Alert de erros gerais (topo) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="mt-3">
                        @csrf

                        {{-- Nome --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome completo</label>
                            <input id="name"
                                   type="text"
                                   class="form-control rounded-pill @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de e-mail</label>
                            <input id="email"
                                   type="email"
                                   class="form-control rounded-pill @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Senha --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password"
                                   type="password"
                                   class="form-control rounded-pill @error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="new-password">

                            {{-- 🔴 Removido o texto de erro vermelho aqui embaixo --}}
                            {{-- Mantemos só o texto explicativo em cinza: --}}
                            <small class="text-muted d-block mt-1">
                                A senha deve ter <strong>pelo menos 8 caracteres</strong>,
                                com <strong>1 letra maiúscula</strong> e
                                <strong>1 caractere especial</strong>.
                            </small>
                        </div>

                        {{-- Confirmar senha --}}
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Confirmar senha</label>
                            <input id="password-confirm"
                                   type="password"
                                   class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold py-2">
                            Registrar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
