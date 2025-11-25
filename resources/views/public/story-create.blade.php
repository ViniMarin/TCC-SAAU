@extends('layouts.app')

@section('title', 'Compartilhar História - SAAU')

{{-- TÍTULO NA FAIXA AZUL (Padrão das páginas internas) --}}
@section('header-content')
    <h1 class="page-header-title">COMPARTILHE SUA HISTÓRIA</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            {{-- Card do Formulário --}}
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-heart fa-3x text-warning"></i>
                        </div>
                        <h3 class="fw-bold text-primary">Conte-nos como foi!</h3>
                        <p class="text-muted">Sua experiência pode inspirar outras pessoas a adotar um amigo. Preencha os dados abaixo e compartilhe sua alegria.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success rounded-3 border-0 shadow-sm mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Verificação de erros de validação --}}
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nome do Adotante (Readonly) --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Adotante</label>
                            <input type="text" class="form-control rounded-pill bg-light border-0 py-2 text-muted" value="{{ auth()->user()->name ?? 'Usuário' }}" disabled>
                            <div class="form-text ms-2 small"><i class="fas fa-info-circle text-primary me-1"></i> Usaremos o nome da sua conta para a publicação.</div>
                        </div>

                        <div class="row mb-4">
                            {{-- Nome do Animal --}}
                            <div class="col-md-6">
                                <label for="animal_name" class="form-label small fw-bold text-muted text-uppercase">Nome do Animal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill bg-white border py-2 @error('animal_name') is-invalid @enderror" id="animal_name" name="animal_name" placeholder="Ex: Rex" value="{{ old('animal_name') }}" required>
                            </div>
                            
                            {{-- Título da História --}}
                            {{-- Se o controller esperar 'title', mantenha. Se não, pode remover ou adaptar --}}
                            {{-- No seu código antigo não tinha título, apenas 'story'. Vou adicionar 'title' como opcional ou hidden se não estiver no banco --}}
                            {{-- Se não tiver campo 'title' no banco, remova este bloco ou mude para hidden --}}
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label for="title" class="form-label small fw-bold text-muted text-uppercase">Título (Opcional)</label>
                                <input type="text" class="form-control rounded-pill bg-white border py-2" id="title" name="title" placeholder="Ex: Um final feliz" value="{{ old('title') }}">
                            </div>
                        </div>

                        {{-- História Completa --}}
                        <div class="mb-4">
                            <label for="story" class="form-label small fw-bold text-muted text-uppercase">Sua História <span class="text-danger">*</span></label>
                            <textarea class="form-control bg-white border p-3 @error('story') is-invalid @enderror" id="story" name="story" rows="6" placeholder="Conte como foi o processo de adoção, adaptação e momentos especiais..." style="border-radius: 15px;" required>{{ old('story') }}</textarea>
                        </div>

                        {{-- Upload de Foto (URL ou Arquivo - Seu código antigo usava URL, o novo usa File. Vou manter File para ser mais moderno, mas se seu backend espera URL, avise) --}}
                        {{-- SE O BACKEND ESPERA UMA URL DE FOTO (string), use este bloco: --}}
                        {{-- 
                        <div class="mb-5">
                            <label for="photo_url" class="form-label small fw-bold text-muted text-uppercase">URL da Foto (Opcional)</label>
                            <input type="url" class="form-control rounded-pill bg-white border py-2" id="photo_url" name="photo_url" placeholder="https://exemplo.com/foto.jpg" value="{{ old('photo_url') }}">
                        </div> 
                        --}}

                        {{-- SE O BACKEND ESPERA UM ARQUIVO (upload), use este bloco (padrão moderno): --}}
                        <div class="mb-5">
                            <label for="photo" class="form-label small fw-bold text-muted text-uppercase">Foto do Pet (Opcional)</label>
                            <div class="input-group">
                                <input type="file" class="form-control rounded-pill bg-light border-0" id="photo" name="photo" accept="image/*">
                                
                            </div>
                            <div class="form-text small text-muted ms-2 mt-1">
                                <i class="fas fa-camera me-1 text-warning"></i> A imagem será exibida após aprovação.
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end align-items-center">
                            <a href="{{ route('stories.index') }}" class="btn btn-link text-muted text-decoration-none fw-bold px-4">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm transition-btn">
                                <i class="fas fa-paper-plane me-2"></i> ENVIAR HISTÓRIA
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
        border-color: var(--saau-blue-primary);
    }
    .transition-btn {
        transition: all 0.3s ease;
    }
    .transition-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 86, 179, 0.2) !important;
    }
</style>
@endsection