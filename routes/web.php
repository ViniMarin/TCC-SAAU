<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAnimalController;
use App\Http\Controllers\AdoptionStoryController;
use App\Http\Controllers\AccessibilityController;

// Rotas de Acessibilidade (Modal com ações individuais)
Route::post('/accessibility/font/increase', [AccessibilityController::class, 'increaseFont'])->name('accessibility.font.increase');
Route::post('/accessibility/font/decrease', [AccessibilityController::class, 'decreaseFont'])->name('accessibility.font.decrease');
Route::post('/accessibility/filter/set', [AccessibilityController::class, 'setFilter'])->name('accessibility.filter.set');
Route::post('/accessibility/reset', [AccessibilityController::class, 'reset'])->name('accessibility.reset');

// Rotas públicas
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/animais', [PublicController::class, 'animals'])->name('animals');
Route::get('/animal/{id}', [PublicController::class, 'animalShow'])->name('animal.show');
Route::post('/animal/{id}/adotar', [PublicController::class, 'adoptionRequest'])
    ->middleware('auth')
    ->name('adoption.request');
Route::get('/eventos', [PublicController::class, 'events'])->name('events');
Route::get('/evento/{id}', [PublicController::class, 'eventShow'])->name('event.show');
Route::get('/rifas', [PublicController::class, 'raffles'])->name('raffles');
Route::get('/rifa/{raffle}', [PublicController::class, 'raffleShow'])->name('raffle.show');
Route::post('/rifa/{raffle}/comprar', [PublicController::class, 'raffleBuy'])->middleware('auth')->name('raffle.buy');
Route::get('/stories', [PublicController::class, 'stories'])->name('stories.index');
Route::middleware('auth')->group(function () {
    Route::get('/stories/create', [PublicController::class, 'createStory'])->name('stories.create');
    Route::post('/stories', [PublicController::class, 'storeStory'])->name('stories.store');
});
Route::get('/faq', function () { return view('faq'); })->name('faq');
Route::get('/como-funciona', function () { return view('how-it-works'); })->name('how-it-works');
Route::get('/como-ajudar', function () { return view('how-to-help'); })->name('how-to-help');

// Histórias de adoção (adotantes autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/minha-historia/criar', [AdoptionStoryController::class, 'create'])->name('adoption-stories.create');
    Route::post('/minha-historia', [AdoptionStoryController::class, 'store'])->name('adoption-stories.store');
});

// Autenticação para adotantes
Auth::routes();

// Redirect /admin para /admin/dashboard ou /admin/login
Route::get('/admin', function () {
    if (auth()->check() && in_array(auth()->user()->role, ['admin', 'veterinario'])) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

// Autenticação para admin
Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [\App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');

// Rotas admin (protegidas - apenas admin e veterinário)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('animals', AdminAnimalController::class);
    Route::resource('adoption-requests', \App\Http\Controllers\Admin\AdoptionRequestController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('raffles', \App\Http\Controllers\Admin\RaffleController::class);
    Route::resource('vaccines', \App\Http\Controllers\Admin\VaccineController::class)->except(['show']);
    Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class)->except(['show']);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
    
    // Histórias de Adoção
    Route::get('/stories', [\App\Http\Controllers\Admin\StoryController::class, 'index'])->name('stories.index');
    Route::patch('/stories/{story}/approve', [\App\Http\Controllers\Admin\StoryController::class, 'approve'])->name('stories.approve');
    Route::delete('/stories/{story}', [\App\Http\Controllers\Admin\StoryController::class, 'destroy'])->name('stories.destroy');
    
    // Relatórios
    Route::get('/reports/animals', [\App\Http\Controllers\Admin\ReportController::class, 'animals'])->name('reports.animals');
    Route::get('/reports/donations', [\App\Http\Controllers\Admin\ReportController::class, 'donations'])->name('reports.donations');
    Route::get('/reports/vaccines', [\App\Http\Controllers\Admin\ReportController::class, 'vaccines'])->name('reports.vaccines');
});
