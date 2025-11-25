@extends('layouts.app')

@section('title', 'Como Ajudar - SAAU')

@section('header-content')
    <h1 class="page-header-title">COMO AJUDAR</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold text-dark mb-4">Faça a Diferença</h2>
            <p class="text-muted lead mb-4">
                A SAAU sobrevive graças à generosidade de pessoas como você. Não recebemos verbas governamentais fixas, por isso cada ajuda conta muito.
            </p>
            <ul class="list-unstyled text-muted">
                <li class="mb-3"><i class="fas fa-check-circle text-warning me-2"></i> Alimentação para centenas de animais</li>
                <li class="mb-3"><i class="fas fa-check-circle text-warning me-2"></i> Medicamentos e tratamentos veterinários</li>
                <li class="mb-3"><i class="fas fa-check-circle text-warning me-2"></i> Manutenção do abrigo e limpeza</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <!-- Card de Doação PIX -->
            <div class="card border-0 shadow-lg" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-hand-holding-heart fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold text-dark">Doação via PIX</h3>
                    <p class="text-muted">Qualquer valor ajuda a salvar vidas!</p>
                    
                    <div class="bg-white border rounded p-3 mb-3 mt-4">
                        <code class="fs-5 text-dark fw-bold" id="pixKey">saau.umuarama@gmail.com</code>
                    </div>
                    <button class="btn btn-outline-primary btn-sm rounded-pill fw-bold" onclick="navigator.clipboard.writeText('saau.umuarama@gmail.com'); alert('Chave PIX copiada!');">
                        <i class="far fa-copy me-1"></i> Copiar Chave
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-hands-helping fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark">Seja Voluntário</h4>
                        <p class="text-muted">
                            Precisamos de ajuda para passear com os cães, dar banho, limpar os canis ou ajudar em eventos. Doe o seu tempo e carinho!
                        </p>
                        {{-- Link para WhatsApp oficial da SAAU --}}
                        <a href="https://wa.me/5544984328357"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-link p-0 text-primary fw-bold text-decoration-none">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-share-alt fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark">Divulgue</h4>
                        <p class="text-muted">
                            Siga as nossas redes sociais e partilhe os animais disponíveis. Quanto mais visibilidade, maiores as hipóteses de adoção!
                        </p>
                        <div class="mt-2">
                            {{-- Instagram oficial --}}
                            <a href="https://www.instagram.com/saau.umuarama/"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-primary me-2">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            {{-- Facebook oficial --}}
                            <a href="https://www.facebook.com/saauajude/?locale=pt_BR"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-primary">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
