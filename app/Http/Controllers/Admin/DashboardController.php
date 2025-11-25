<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AdoptionRequest;
use App\Models\Event;
use App\Models\Raffle;
use App\Models\Donation;
use App\Models\User;
use App\Models\Vaccine;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            // Animais
            'total_animals' => Animal::count(),
            'new_animals_month' => Animal::whereMonth('created_at', now()->month)->count(),

            // Adoções
            'adopted' => AdoptionRequest::where('status', 'aprovado')->count(),
            'pending_requests' => AdoptionRequest::where('status', 'pendente')->count(),

            // Usuários
            'total_users' => User::count(),
            'new_users_month' => User::whereMonth('created_at', now()->month)->count(),

            // Rifas
            'active_raffles' => Raffle::where('status', 'ativa')->count(),
            'total_raffles' => Raffle::count(),

            // Outros
            'active_events' => Event::where('active', true)->count(),
            'total_donations' => Donation::sum('amount'),
            'total_vaccines' => Vaccine::count(),
            'castrated' => Animal::where('castrated', true)->count(),
            'vaccinated' => Animal::where('vaccinated', true)->count(),
        ];

        $recent_requests = AdoptionRequest::with('animal')->latest()->take(5)->get();
        $recent_animals = Animal::latest()->take(5)->get();
        $recent_donations = Donation::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_requests', 'recent_animals', 'recent_donations'));
    }
}
