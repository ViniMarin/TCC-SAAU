<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Raffle;
use App\Models\Vaccine;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function export(Request $request)
    {
        $request->merge([
            'type'       => $request->input('type', 'all'),
            'start_date' => $this->normalizeDate($request->input('start_date')),
            'end_date'   => $this->normalizeDate($request->input('end_date')),
        ]);

        $validated = $request->validate([
            'type'       => 'required|in:all,animals,vaccines,raffles,events,donations',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $this->parseDate($validated['start_date'] ?? null);
        $endDate   = $this->parseDate($validated['end_date'] ?? null)?->endOfDay();

        $data = [
            'filters' => [
                'type'       => $validated['type'],
                'start_date' => $startDate?->format('d/m/Y'),
                'end_date'   => $endDate?->format('d/m/Y'),
            ],
            'animals' => $this->shouldInclude('animals', $validated['type'])
                ? $this->getAnimals($startDate, $endDate)
                : collect(),
            'vaccines' => $this->shouldInclude('vaccines', $validated['type'])
                ? $this->getVaccines($startDate, $endDate)
                : collect(),
            'raffles' => $this->shouldInclude('raffles', $validated['type'])
                ? $this->getRaffles($startDate, $endDate)
                : collect(),
            'events' => $this->shouldInclude('events', $validated['type'])
                ? $this->getEvents($startDate, $endDate)
                : collect(),
            'donations' => $this->shouldInclude('donations', $validated['type'])
                ? $this->getDonations($startDate, $endDate)
                : collect(),
        ];

        $pdf = Pdf::loadView('admin.reports.pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download(
            'relatorio_' . $validated['type'] . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf'
        );
    }

    private function normalizeDate(?string $value): ?string
    {
        if (!$value) {
            return $value;
        }

        $value = trim($value);

        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $value)) {
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

    private function parseDate(?string $value): ?Carbon
    {
        if (!$value) {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (\Exception) {
            return null;
        }
    }

    private function shouldInclude(string $section, string $type): bool
    {
        return $type === 'all' || $type === $section;
    }

    private function applyDateFilter($query, string $column, ?Carbon $startDate, ?Carbon $endDate)
    {
        if ($startDate) {
            $query->whereDate($column, '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate($column, '<=', $endDate);
        }

        return $query;
    }

    private function getAnimals(?Carbon $startDate, ?Carbon $endDate)
    {
        $query = Animal::query()->orderByDesc('created_at');
        $this->applyDateFilter($query, 'created_at', $startDate, $endDate);

        return $query->get();
    }

    private function getVaccines(?Carbon $startDate, ?Carbon $endDate)
    {
        $query = Vaccine::with('animal')->orderByDesc('application_date');
        $this->applyDateFilter($query, 'application_date', $startDate, $endDate);

        return $query->get();
    }

    private function getRaffles(?Carbon $startDate, ?Carbon $endDate)
    {
        $query = Raffle::query()->orderByDesc('draw_date');
        $this->applyDateFilter($query, 'draw_date', $startDate, $endDate);

        return $query->get();
    }

    private function getEvents(?Carbon $startDate, ?Carbon $endDate)
    {
        $query = Event::query()->orderByDesc('date');
        $this->applyDateFilter($query, 'date', $startDate, $endDate);

        return $query->get();
    }

    private function getDonations(?Carbon $startDate, ?Carbon $endDate)
    {
        $query = Donation::query()->orderByDesc('date');
        $this->applyDateFilter($query, 'date', $startDate, $endDate);

        return $query->get();
    }
}
