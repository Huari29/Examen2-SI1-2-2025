<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Services\ReporteService;

class ReporteController extends Controller
{
    // 🔹 Mostrar formulario de filtros
    public function index()
    {
        $docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
        return view('reportes.generar-reportes-academicos-y-administrativos.index', compact('docentes'));
    }

    // 🔹 Generar reporte en pantalla o exportable
    public function generar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:asistencia,horario,aula,carga',
        ]);

        $filtros = [
            'docente' => $request->docente,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'gestion' => $request->gestion,
        ];

        $reporteService = new ReporteService();
        $resultado = $reporteService->generar($request->tipo, $filtros);

        if ($resultado->isEmpty()) {
            return back()->with('error', '⚠️ No se encontraron registros con los filtros seleccionados.');
        }

        // ✅ Exportar según el formato solicitado
        if ($request->has('exportar_pdf')) {
            return $reporteService->exportarPDF($resultado, $request->tipo);
        }

        if ($request->has('exportar_excel')) {
            return $reporteService->exportarExcel($resultado, $request->tipo);
        }

        if ($request->has('exportar_word')) {
            return $reporteService->exportarWord($resultado, $request->tipo);
        }

        // ✅ Mostrar en pantalla si no se pidió exportar
        return view('reportes.generar-reportes-academicos-y-administrativos.resultado', compact('resultado'));
    }
}
