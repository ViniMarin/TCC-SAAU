<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use Illuminate\Http\Request;

class AdoptionRequestController extends Controller
{
    /**
     * Listagem dos pedidos de adoção.
     */
    public function index()
    {
        $requests = AdoptionRequest::with('animal')
            ->latest()
            ->paginate(15);

        return view('admin.adoption-requests.index', compact('requests'));
    }

    /**
     * Tela de detalhes do pedido.
     */
    public function show(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->load('animal');

        return view('admin.adoption-requests.show', compact('adoptionRequest'));
    }

    /**
     * Tela de edição do pedido (acessada pelo botão Editar da lista
     * e pelo botão "Ir para edição do pedido" na tela de detalhes).
     */
    public function edit(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->load('animal');

        return view('admin.adoption-requests.edit', compact('adoptionRequest'));
    }

    /**
     * Atualiza status e observações do pedido.
     */
    public function update(Request $request, AdoptionRequest $adoptionRequest)
    {
        $validated = $request->validate([
            'status'      => 'required|in:pendente,aprovado,rejeitado',
            'admin_notes' => 'nullable|string',
        ]);

        $adoptionRequest->update($validated);

        // Se aprovado, atualizar status do animal vinculado
        if ($validated['status'] === 'aprovado' && $adoptionRequest->animal) {
            $adoptionRequest->animal->update(['status' => 'adotado']);
        }

        return redirect()
            ->route('admin.adoption-requests.index')
            ->with('success', 'Pedido de adoção atualizado com sucesso!');
    }

    /**
     * Exclui o pedido.
     */
    public function destroy(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->delete();

        return redirect()
            ->route('admin.adoption-requests.index')
            ->with('success', 'Pedido de adoção removido com sucesso!');
    }
}
