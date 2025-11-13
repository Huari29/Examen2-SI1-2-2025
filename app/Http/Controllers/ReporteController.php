<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Horario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Services\ReporteService;

class ReporteController extends Controller
{
    // 🔹 Mostrar formulario de filtros
    public function index()
    {
        $docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
        return view('reportes.index', compact('docentes'));
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

        if ($request->has('exportar_pdf')) {
            return $reporteService->exportarPDF($resultado, $request->tipo);
        }

        return view('reportes.resultado', compact('resultado'));
    }
}
