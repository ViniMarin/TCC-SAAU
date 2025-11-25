<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\RaffleTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RafflePublicController extends Controller
{
    // /rifas – lista todas as rifas ativas
    public function index()
    {
        $raffles = Raffle::where('status', 'ativa')
            ->orderBy('created_at', 'desc')
            ->get();

        // resources/views/public/raffles.blade.php
        return view('public.raffles', compact('raffles'));
    }

    // /rifas/{raffle} – detalhes da rifa
    public function show(Raffle $raffle)
    {
        $ticketsSold = $raffle->tickets()->count();

        $userTickets = [];
        if (Auth::check()) {
            $userTickets = $raffle->tickets()
                ->where('user_id', Auth::id())
                ->orderBy('number')
                ->pluck('number')
                ->toArray();
        }

        // resources/views/public/raffle-show.blade.php  👈 (singular)
        return view('public.raffle-show', [
            'raffle'      => $raffle,
            'ticketsSold' => $ticketsSold,
            'userTickets' => $userTickets,
        ]);
    }

    // POST /rifas/{raffle}/comprar – gera números aleatórios sem repetir
    public function buy(Request $request, Raffle $raffle)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado para comprar números.');
        }

        $totalSold = $raffle->tickets()->count();
        $remaining = $raffle->total_tickets - $totalSold;

        if ($remaining <= 0) {
            return back()->with('error', 'Todos os números desta rifa já foram vendidos.');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $remaining,
        ]);

        $quantity = $validated['quantity'];

        // Números já usados nessa rifa
        $usedNumbers = $raffle->tickets()->pluck('number')->toArray();
        $usedSet     = array_flip($usedNumbers);

        $generated   = [];
        $maxAttempts = $quantity * 10;

        while (count($generated) < $quantity && $maxAttempts > 0) {
            $maxAttempts--;

            $n = random_int(1, $raffle->total_tickets);

            if (!isset($usedSet[$n]) && !in_array($n, $generated)) {
                $generated[] = $n;
                $usedSet[$n] = true;
            }
        }

        if (count($generated) < $quantity) {
            return back()->with('error', 'Não foi possível gerar os números da rifa. Tente novamente.');
        }

        foreach ($generated as $n) {
            RaffleTicket::create([
                'user_id'   => Auth::id(),
                'raffle_id' => $raffle->id,
                'number'    => $n,
            ]);
        }

        $numbersList = implode(', ', $generated);

        return back()->with('success', "Compra realizada com sucesso! Seus números são: {$numbersList}");
    }
}
