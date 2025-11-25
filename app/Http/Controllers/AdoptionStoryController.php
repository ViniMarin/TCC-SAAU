<?php

namespace App\Http\Controllers;

use App\Models\AdoptionStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionStoryController extends Controller
{
    /**
     * (Opcional) Se futuramente quiser listar as histórias do próprio adotante.
     * No momento, quem lista na rota /stories é o PublicController.
     */
    public function index()
    {
        $stories = AdoptionStory::where('adopter_name', Auth::user()?->name)
            ->latest()
            ->paginate(9);

        return view('public.stories', compact('stories'));
    }

    /**
     * Formulário (caso você use a rota /minha-historia/criar).
     * Usa a mesma view de "Compartilhe sua história".
     */
    public function create()
    {
        return view('public.story-create');
    }

    /**
     * Salva a história com upload de foto.
     * Rota: POST /minha-historia  (adoption-stories.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'animal_name' => 'required|string|max:255',
            'story'       => 'required|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data = [
            'adopter_name' => Auth::user()->name,
            'animal_name'  => $request->animal_name,
            'story'        => $request->story,
            'approved'     => false, // vai aparecer como "Pendente" no admin
        ];

        if ($request->hasFile('photo')) {
            // Salva em storage/app/public/stories
            // No banco fica só "stories/arquivo.jpg"
            $path = $request->file('photo')->store('stories', 'public');
            $data['photo_url'] = $path;
        }

        AdoptionStory::create($data);

        return redirect()
            ->route('stories.index')
            ->with('success', 'Sua história foi enviada com sucesso e aguarda aprovação!');
    }
}
