<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Donation;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function animals(Request $request)
    {
        $query = Animal::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $animals = $query->get();

        $filename = 'relatorio_animais_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($animals) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalho
            fputcsv($file, ['ID', 'Nome', 'Espécie', 'Raça', 'Idade', 'Sexo', 'Porte', 'Status', 'Castrado', 'Vacinado', 'Data Cadastro'], ';');

            // Dados
            foreach ($animals as $animal) {
                fputcsv($file, [
                    $animal->id,
                    $animal->name,
                    $animal->species,
                    $animal->breed ?? '-',
                    $animal->age,
                    $animal->gender,
                    $animal->size ?? '-',
                    $animal->status,
                    $animal->castrated ? 'Sim' : 'Não',
                    $animal->vaccinated ? 'Sim' : 'Não',
                    $animal->created_at->format('d/m/Y')
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function donations(Request $request)
    {
        $query = Donation::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $donations = $query->orderBy('date', 'desc')->get();

        $filename = 'relatorio_doacoes_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalho
            fputcsv($file, ['ID', 'Data', 'Valor', 'Tipo', 'Doador', 'Observações'], ';');

            // Dados
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    \Carbon\Carbon::parse($donation->date)->format('d/m/Y'),
                    'R$ ' . number_format($donation->amount, 2, ',', '.'),
                    $donation->donation_type,
                    $donation->donor_name ?? 'Anônimo',
                    $donation->notes ?? '-'
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function vaccines(Request $request)
    {
        $query = Vaccine::with('animal');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('application_date', [$request->start_date, $request->end_date]);
        }

        $vaccines = $query->orderBy('application_date', 'desc')->get();

        $filename = 'relatorio_vacinas_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($vaccines) {
            $file = fopen('php://output', 'w');
            
            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalho
            fputcsv($file, ['ID', 'Animal', 'Tipo de Vacina', 'Data Aplicação', 'Próxima Dose', 'Observações'], ';');

            // Dados
            foreach ($vaccines as $vaccine) {
                fputcsv($file, [
                    $vaccine->id,
                    $vaccine->animal->name ?? 'N/A',
                    $vaccine->vaccine_type,
                    \Carbon\Carbon::parse($vaccine->application_date)->format('d/m/Y'),
                    $vaccine->next_dose_date ? \Carbon\Carbon::parse($vaccine->next_dose_date)->format('d/m/Y') : '-',
                    $vaccine->notes ?? '-'
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
