<?php

namespace App\Services;

use App\Models\Asistencia;
use App\Models\Horario;
use App\Models\Aula;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ReporteService
{
    /**
     * Generar datos según el tipo de reporte y los filtros
     */
    public function generar(string $tipo, array $filtros): Collection
    {
        return match ($tipo) {
            'asistencia' => $this->reporteAsistencia($filtros),
            'horario'    => $this->reporteHorarios($filtros),
            'aula'       => $this->reporteAulas($filtros),
            'carga'      => $this->reporteCargaHoraria($filtros),
            default      => collect(),
        };
    }

    private function reporteAsistencia($filtros): Collection
    {
        $query = Asistencia::query()->with(['docente', 'horario']);
        if ($filtros['docente']) $query->where('id_docente', $filtros['docente']);
        if ($filtros['fecha_inicio']) $query->whereDate('fecha', '>=', $filtros['fecha_inicio']);
        if ($filtros['fecha_fin']) $query->whereDate('fecha', '<=', $filtros['fecha_fin']);
        return $query->get();
    }

    private function reporteHorarios($filtros): Collection
    {
        $query = Horario::query()->with(['materia', 'docente', 'aula']);
        if ($filtros['docente']) $query->where('id_docente', $filtros['docente']);
        return $query->get();
    }

    private function reporteAulas($filtros): Collection
    {
        return Aula::all();
    }

    private function reporteCargaHoraria($filtros): Collection
    {
        $query = Horario::query()->selectRaw('id_docente, COUNT(*) as cantidad_horarios')
            ->groupBy('id_docente')
            ->with('docente');
        return $query->get();
    }

    /**
     * Exportar resultados a PDF
     */
    public function exportarPDF(Collection $resultado, string $tipo)
    {
        $pdf = Pdf::loadView('reportes.generar-reportes-academicos-y-administrativos.resultado_pdf', [
            'resultado' => $resultado,
            'tipo' => $tipo
        ])->setPaper('a4', 'landscape');

        return $pdf->download("reporte_{$tipo}.pdf");
    }

    /**
     * Exportar resultados a Excel
     */
    public function exportarExcel(Collection $resultado, string $tipo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($resultado->isNotEmpty()) {
            $headers = array_keys($resultado->first()->getAttributes());
            $sheet->fromArray([$headers], null, 'A1');
            $sheet->fromArray($resultado->map->getAttributes()->toArray(), null, 'A2');
        }

        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path("app/public/reporte_{$tipo}.xlsx");
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Exportar resultados a Word
     */
    public function exportarWord(Collection $resultado, string $tipo)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addTitle("Reporte de " . ucfirst($tipo), 1);

        if ($resultado->isEmpty()) {
            $section->addText("No se encontraron resultados con los filtros seleccionados.");
        } else {
            $table = $section->addTable();

            // Encabezados
            $headers = array_keys($resultado->first()->getAttributes());
            $table->addRow();
            foreach ($headers as $header) {
                $table->addCell(2000)->addText(strtoupper($header));
            }

            // Filas
            foreach ($resultado as $fila) {
                $table->addRow();
                foreach ($fila->getAttributes() as $valor) {
                    $table->addCell(2000)->addText($valor ?? '');
                }
            }
        }

        $filePath = storage_path("app/public/reporte_{$tipo}.docx");
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
