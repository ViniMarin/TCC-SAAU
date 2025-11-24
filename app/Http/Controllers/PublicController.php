<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Event;
use App\Models\Raffle;
use App\Models\AdoptionStory;
use App\Models\AdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        $stats = [
            'animals' => Animal::count(),
            'adopted' => Animal::where('status', 'adotado')->count(),
            'events' => Event::where('active', true)->count(),
            'raffles' => Raffle::where('status', 'ativa')->count(),
        ];

        $animals = Animal::where('status', 'disponivel')->latest()->take(6)->get();
        $events = Event::where('active', true)->latest()->take(3)->get();

        return view('public.home', compact('stats', 'animals', 'events'));
    }

    public function animals(Request $request)
    {
        $query = Animal::where('status', 'disponivel');

        if ($request->filled('species')) {
            $query->where('species', $request->input('species'));
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('age')) {
            $query->where('age', $request->input('age'));
        }

        if ($request->filled('size')) {
            $query->where('size', $request->input('size'));
        }

        $animals = $query->latest()->paginate(12)->withQueryString();

        return view('public.animals', compact('animals'));
    }

    public function animalShow($id)
    {
        $animal = Animal::findOrFail($id);
        return view('public.animal-show', compact('animal'));
    }

    public function adoptionRequest(Request $request, $id)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'city_state' => 'required|string',
            'housing_type' => 'required|string',
            'had_pets' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $user = $request->user();

        AdoptionRequest::create([
            'id' => Str::uuid(),
            'animal_id' => $id,
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => $validated['phone'],
            'city_state' => $validated['city_state'],
            'housing_type' => $validated['housing_type'],
            'had_pets' => $validated['had_pets'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'pendente',
        ]);

        return redirect()->route('animal.show', $id)->with('success', 'Pedido de adoção enviado com sucesso!');
    }

    public function events()
    {
        $events = Event::where('active', true)->latest()->paginate(9);
        return view('public.events', compact('events'));
    }

    public function raffles()
    {
        $raffles = Raffle::where('status', 'ativa')->latest()->paginate(9);
        $eventsWithImages = Event::where('active', true)
            ->whereNotNull('image_url')
            ->latest()
            ->get();

        return view('public.raffles', compact('raffles', 'eventsWithImages'));
    }

    public function stories()
    {
        $stories = AdoptionStory::where('approved', true)->latest()->paginate(9);
        return view('public.stories', compact('stories'));
    }

    public function createStory(Request $request)
    {
        $adopterName = $request->user()->name;

        return view('public.story-create', compact('adopterName'));
    }

    public function storeStory(Request $request)
    {
        $validated = $request->validate([
            'animal_name' => 'required|string|max:255',
            'story' => 'required|string',
            'photo_url' => 'nullable|url',
        ]);

        AdoptionStory::create([
            'adopter_name' => $request->user()->name,
            'animal_name' => $validated['animal_name'],
            'story' => $validated['story'],
            'photo_url' => $validated['photo_url'] ?? null,
            'approved' => false,
        ]);

        return redirect()->route('stories.index')->with('success', 'História enviada com sucesso e aguarda aprovação.');
    }
}
