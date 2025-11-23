<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RaffleController extends Controller
{

    public function index()
    {
        $raffles = Raffle::latest()->paginate(10);
        return view('admin.raffles.index', compact('raffles'));
    }

    public function create()
    {
        return view('admin.raffles.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'draw_date' => $this->normalizeDrawDate($request->input('draw_date')),
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prize' => 'nullable|string|max:255',
            'ticket_price' => ['required', 'regex:/^\d+(?:[\.,]\d{2})?$/'],
            'total_tickets' => 'required|integer|min:1',
            'draw_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:ativa,pausada,encerrada',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['description'] = $validated['description'] ?? '';
        $validated['prize'] = $validated['prize'] ?? '';
        $validated['ticket_price'] = $this->normalizeCurrency($validated['ticket_price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('raffles', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        Raffle::create($validated);

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa criada com sucesso!');
    }

    public function edit(Raffle $raffle)
    {
        return view('admin.raffles.edit', compact('raffle'));
    }

    public function update(Request $request, Raffle $raffle)
    {
        $request->merge([
            'draw_date' => $this->normalizeDrawDate($request->input('draw_date')),
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prize' => 'nullable|string|max:255',
            'ticket_price' => ['required', 'regex:/^\d+(?:[\.,]\d{2})?$/'],
            'total_tickets' => 'required|integer|min:1',
            'draw_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:ativa,pausada,encerrada',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['description'] = $validated['description'] ?? '';
        $validated['prize'] = $validated['prize'] ?? '';
        $validated['ticket_price'] = $this->normalizeCurrency($validated['ticket_price']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($raffle->image_url) {
                $oldPath = str_replace('/storage/', '', $raffle->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('raffles', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $raffle->update($validated);

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa atualizada com sucesso!');
    }

    private function normalizeCurrency(string $value): float
    {
        $clean = preg_replace('/[^0-9,\.]/', '', $value);
        $clean = str_replace('.', '', $clean);
        $clean = str_replace(',', '.', $clean);

        return (float) number_format((float) $clean, 2, '.', '');
    }

    private function normalizeDrawDate(?string $value): ?string
    {
        if (!$value) {
            return $value;
        }

        $value = trim($value);

        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $value, $matches)) {
            try {
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch (\Exception) {
                return $value;
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception) {
            return $value;
        }
    }

    public function destroy(Raffle $raffle)
    {
        // Delete image
        if ($raffle->image_url) {
            $oldPath = public_path($raffle->image_url);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $raffle->delete();

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa removida com sucesso!');
    }
}
