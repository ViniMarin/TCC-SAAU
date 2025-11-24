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
        $request->merge(['type' => $request->input('type', 'all')]);

        $validated = $request->validate([
            'type' => 'required|in:all,animals,vaccines,raffles,events,donations',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'] ? Carbon::parse($validated['start_date'])->startOfDay() : null;
        $endDate = $validated['end_date'] ? Carbon::parse($validated['end_date'])->endOfDay() : null;
        $type = $validated['type'];

        $reports = $this->getReportData($startDate, $endDate, $type);

        $pdf = Pdf::loadView('admin.reports.pdf', [
            'type' => $type,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'reports' => $reports,
            'generatedAt' => now(),
        ])->setPaper('a4', 'portrait');

        $filename = 'relatorio_' . ($type === 'all' ? 'completo' : $type) . '_' . now()->format('Y-m-d_H-i') . '.pdf';

        return $pdf->download($filename);
    }

    protected function getReportData(?Carbon $startDate, ?Carbon $endDate, string $type): array
    {
        $reports = [];

        if ($type === 'all' || $type === 'animals') {
            $animalQuery = Animal::orderBy('created_at', 'desc');
            $reports['animals'] = $this->filterByDate($animalQuery, 'created_at', $startDate, $endDate)->get();
        }

        if ($type === 'all' || $type === 'vaccines') {
            $vaccineQuery = Vaccine::with('animal')->orderBy('application_date', 'desc');
            $reports['vaccines'] = $this->filterByDate($vaccineQuery, 'application_date', $startDate, $endDate)->get();
        }

        if ($type === 'all' || $type === 'raffles') {
            $raffleQuery = Raffle::orderBy('draw_date', 'desc');
            $reports['raffles'] = $this->filterByDate($raffleQuery, 'draw_date', $startDate, $endDate)->get();
        }

        if ($type === 'all' || $type === 'events') {
            $eventQuery = Event::orderBy('date', 'desc');
            $reports['events'] = $this->filterByDate($eventQuery, 'date', $startDate, $endDate)->get();
        }

        if ($type === 'all' || $type === 'donations') {
            $donationQuery = Donation::orderBy('date', 'desc');
            $reports['donations'] = $this->filterByDate($donationQuery, 'date', $startDate, $endDate)->get();
        }

        return $reports;
    }

    protected function filterByDate($query, string $column, ?Carbon $startDate, ?Carbon $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween($column, [$startDate, $endDate]);
        }

        if ($startDate) {
            return $query->whereDate($column, '>=', $startDate);
        }

        if ($endDate) {
            return $query->whereDate($column, '<=', $endDate);
        }

        return $query;
    }
}
