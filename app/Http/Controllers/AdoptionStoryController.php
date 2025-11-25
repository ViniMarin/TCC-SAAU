<?php

namespace App\Http\Controllers;

use App\Models\AdoptionStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdoptionStoryController extends Controller
{
    public function index()
    {
        // Mostra apenas histórias aprovadas na área pública
        $stories = AdoptionStory::where('is_approved', true)->latest()->paginate(9);
        return view('public.stories', compact('stories'));
    }

    public function create()
    {
        return view('public.adoption-stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'story' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'adopter_name' => Auth::user()->name,
            'animal_name' => $request->animal_name,
            'title' => $request->title,
            'story' => $request->story,
            'is_approved' => false, // Precisa de aprovação do admin
        ];

        if ($request->hasFile('photo')) {
            // Salva a imagem na pasta 'storage/app/public/adoption_stories'
            $path = $request->file('photo')->store('adoption_stories', 'public');
            
            // Gera a URL pública: /storage/adoption_stories/nome_arquivo.jpg
            $data['photo_url'] = Storage::url($path);
        }

        AdoptionStory::create($data);

        return redirect()->route('stories.index')->with('success', 'Sua história foi enviada com sucesso e aguarda aprovação!');
    }
}