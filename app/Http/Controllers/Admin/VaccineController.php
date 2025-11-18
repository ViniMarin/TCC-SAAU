<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vaccine;
use App\Models\Animal;
use Illuminate\Http\Request;

class VaccineController extends Controller
{

    public function index()
    {
        $vaccines = Vaccine::with('animal')->latest()->paginate(15);
        return view('admin.vaccines.index', compact('vaccines'));
    }

    public function create()
    {
        $animals = Animal::where('status', '!=', 'adotado')->orderBy('name')->get();
        return view('admin.vaccines.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'vaccine_type' => 'required|string|max:255',
            'application_date' => 'required|date',
            'next_dose_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $validated['created_by'] = auth()->id();

        Vaccine::create($validated);

        return redirect()->route('admin.vaccines.index')
            ->with('success', 'Vacina registrada com sucesso!');
    }

    public function edit(Vaccine $vaccine)
    {
        $animals = Animal::where('status', '!=', 'adotado')->orderBy('name')->get();
        return view('admin.vaccines.edit', compact('vaccine', 'animals'));
    }

    public function update(Request $request, Vaccine $vaccine)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'vaccine_type' => 'required|string|max:255',
            'application_date' => 'required|date',
            'next_dose_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $vaccine->update($validated);

        return redirect()->route('admin.vaccines.index')
            ->with('success', 'Vacina atualizada com sucesso!');
    }

    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();
        return redirect()->route('admin.vaccines.index')
            ->with('success', 'Registro de vacina removido com sucesso!');
    }
}
