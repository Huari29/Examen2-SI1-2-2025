<?php

namespace App\Services;

use App\Models\Asistencia;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteService
{
    public function generar($tipo, $filtros)
    {
        return match ($tipo) {
            'asistencia' => $this->consultarAsistencia($filtros),
            'horario' => $this->consultarHorario($filtros),
            'aula' => $this->consultarAulas($filtros),
            'carga' => $this->consultarCarga($filtros),
            default => collect()
        };
    }

    private function consultarAsistencia($filtros)
    {
        return Asistencia::with(['detalle.materiaGrupo.docente'])
            ->when($filtros['docente'], fn($q) => $q->whereHas('detalle.materiaGrupo', fn($q2) => 
                $q2->where('id_docente', $filtros['docente'])
            ))
            ->when($filtros['fecha_inicio'], fn($q) => $q->whereDate('fecha', '>=', $filtros['fecha_inicio']))
            ->when($filtros['fecha_fin'], fn($q) => $q->whereDate('fecha', '<=', $filtros['fecha_fin']))
            ->get();
    }

    private function consultarHorario($filtros)
    {
        return Horario::with('detalleHorario.materiaGrupo.docente')->get();
    }

    private function consultarAulas($filtros)
    {
        return Horario::with('detalleHorario.aula')->get();
    }

    private function consultarCarga($filtros)
    {
        return Horario::with('detalleHorario.materiaGrupo.materia')->get();
    }

    public function exportarPDF($datos, $tipo)
    {
        $pdf = Pdf::loadView('reportes.pdf', ['datos' => $datos, 'tipo' => $tipo]);
        return $pdf->download("reporte_{$tipo}.pdf");
    }
}
