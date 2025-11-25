<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAnimalController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AdoptionStoryController;

// Rotas públicas
Route::get('/', [PublicController::class, 'home'])->name('home');

Route::get('/animais', [PublicController::class, 'animals'])->name('animals');
Route::get('/animal/{id}', [PublicController::class, 'animalShow'])->name('animal.show');
Route::post('/animal/{id}/adotar', [PublicController::class, 'adoptionRequest'])
    ->middleware('auth')
    ->name('adoption.request');

// Eventos
Route::get('/eventos', [PublicController::class, 'events'])->name('events');
Route::get('/eventos/{event}', [PublicController::class, 'eventShow'])->name('events.show');

// Rifas
Route::get('/rifas', [PublicController::class, 'raffles'])->name('raffles');
Route::get('/rifas/{raffle}', [PublicController::class, 'raffleShow'])->name('raffle.show');

// Histórias públicas (listagem)
Route::get('/stories', [PublicController::class, 'stories'])->name('stories.index');

// Formulário de histórias (fluxo atual do PublicController)
Route::middleware('auth')->group(function () {
    Route::get('/stories/create', [PublicController::class, 'createStory'])->name('stories.create');
    Route::post('/stories', [PublicController::class, 'storeStory'])->name('stories.store');
});

// Página "LER COMPLETA" da história
Route::get('/stories/{story}', [PublicController::class, 'storyShow'])->name('stories.show');

// Histórias de adoção (fluxo antigo /minha-historia, se ainda for usar)
Route::middleware('auth')->group(function () {
    Route::get('/minha-historia/criar', [AdoptionStoryController::class, 'create'])->name('adoption-stories.create');
    Route::post('/minha-historia', [AdoptionStoryController::class, 'store'])->name('adoption-stories.store');
});

// Páginas estáticas
Route::get('/faq', fn () => view('faq'))->name('faq');
Route::get('/como-funciona', fn () => view('how-it-works'))->name('how-it-works');
Route::get('/como-ajudar', fn () => view('how-to-help'))->name('how-to-help');

// Autenticação para adotantes (guard padrão "web")
Auth::routes();

// Redirect /admin para /admin/dashboard ou /admin/login
Route::get('/admin', function () {
    if (auth()->check() && in_array(auth()->user()->role, ['admin', 'veterinario', 'usuario'])) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

// Autenticação para admin
Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [\App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');

// Rotas admin (protegidas - admin, veterinário e usuário comum já passam pelo CheckAdmin)
Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard visível para qualquer perfil que tenha acesso ao painel
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * ÁREA APENAS ADMIN
         * - Pedidos de adoção
         * - Doações
         * - Usuários
         * - Relatórios
         */
        Route::middleware('role:admin')->group(function () {
            Route::resource('adoption-requests', \App\Http\Controllers\Admin\AdoptionRequestController::class);
            Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class);
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

            Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
            Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
        });

        /*
         * ÁREA ADMIN + VETERINÁRIO
         * - Vacinas
         */
        Route::middleware('role:admin,veterinario')->group(function () {
            Route::resource('vaccines', \App\Http\Controllers\Admin\VaccineController::class);
        });

        /*
         * ÁREA ADMIN + VETERINÁRIO + USUÁRIO COMUM
         * - Animais
         * - Eventos
         * - Rifas
         * - Histórias
         */
        Route::middleware('role:admin,veterinario,usuario')->group(function () {
            Route::resource('animals', \App\Http\Controllers\Admin\AdminAnimalController::class);
            Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
            Route::resource('raffles', \App\Http\Controllers\Admin\RaffleController::class);

            // Histórias de Adoção (painel admin)
            Route::get('/stories', [\App\Http\Controllers\Admin\StoryController::class, 'index'])->name('stories.index');
            Route::patch('/stories/{story}/approve', [\App\Http\Controllers\Admin\StoryController::class, 'approve'])->name('stories.approve');
            Route::delete('/stories/{story}', [\App\Http\Controllers\Admin\StoryController::class, 'destroy'])->name('stories.destroy');
        });
    });
