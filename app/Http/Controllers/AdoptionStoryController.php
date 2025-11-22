<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\AdoptionStory;
use Illuminate\Http\Request;

class AdoptionStoryController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();
        $approvedRequests = $this->approvedAdoptionsForUser($user);

        if ($approvedRequests->isEmpty()) {
            return redirect()->route('stories.index')
                ->with('error', 'Você precisa ter uma adoção aprovada para compartilhar sua história.');
        }

        return view('public.adoption-stories.create', [
            'user' => $user,
            'adoptedAnimals' => $approvedRequests,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $approvedRequests = $this->approvedAdoptionsForUser($user);

        if ($approvedRequests->isEmpty()) {
            return redirect()->route('stories.index')
                ->with('error', 'Você precisa ter uma adoção aprovada para compartilhar sua história.');
        }

        $validated = $request->validate([
            'animal_name' => 'required|string|max:255',
            'story' => 'required|string|min:50',
            'photo' => 'nullable|image|max:5120',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('stories', 'public');
            $photoPath = '/storage/' . $photoPath;
        }

        AdoptionStory::create([
            'adopter_name' => $user->name,
            'animal_name' => $validated['animal_name'],
            'story' => $validated['story'],
            'photo_url' => $photoPath,
            'approved' => false,
        ]);

        return redirect()->route('stories.index')
            ->with('success', 'História enviada para avaliação! Entraremos em contato após a aprovação.');
    }

    protected function approvedAdoptionsForUser($user)
    {
        return AdoptionRequest::with('animal')
            ->where('email', $user->email)
            ->where('status', 'aprovado')
            ->get()
            ->map(function ($request) {
                return [
                    'animal_name' => optional($request->animal)->name ?? $request->animal_id,
                ];
            });
    }
}
