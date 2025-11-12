<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class InconsistenciaController extends Controller
{
    // 🔹 Vista de inconsistencias (y faltas) para el docente
    public function indexDocente()
    {
        $docenteId = Auth::user()->id_usuario;

        $inconsistencias = Asistencia::with(['detalleHorario.materiaGrupo.materia', 'detalleHorario.materiaGrupo.grupo'])
            ->whereIn('estado', ['Inconsistente', 'Falta'])
            ->whereHas('detalleHorario.materiaGrupo', fn($q) => $q->where('id_docente', $docenteId))
            ->orderByDesc('fecha')
            ->get();

        return view('asistencia-docente.resolver-inconsistencias-de-asistencias.docente', compact('inconsistencias'));
    }

    // 🔹 Justificación del docente (si tuvo falta o inconsistencia)
    public function justificar(Request $request, $id)
    {
        $request->validate(['observacion' => 'required|string|max:255']);

        $asistencia = Asistencia::findOrFail($id);
        $asistencia->update([
            'observacion' => $request->observacion,
            'estado' => 'Resuelta',
        ]);

        return back()->with('success', '✅ Justificación enviada correctamente.');
    }

    // 🔹 Vista de inconsistencias (y faltas) para el administrador
    public function indexAdmin()
    {
        $inconsistencias = Asistencia::with(['detalleHorario.materiaGrupo.docente', 'detalleHorario.aula', 'detalleHorario.horario'])
            ->whereIn('estado', ['Inconsistente', 'Resuelta', 'Falta'])
            ->orderByDesc('fecha')
            ->get();

        return view('asistencia-docente.validar-inconsistencias-de-asistencias.administrador', compact('inconsistencias'));
    }

    // 🔹 Resolver inconsistencia o falta (admin)
    public function resolver(Request $request, $id)
    {
        $request->validate(['accion' => 'required|in:aceptar,rechazar']);

        $asistencia = Asistencia::findOrFail($id);

        if ($request->accion === 'aceptar') {
            $asistencia->estado = 'Validada';
        } else {
            $asistencia->estado = 'Rechazada';
            $asistencia->observacion = $request->observacion ?? 'Falta no justificada.';
        }

        $asistencia->save();

        return back()->with('success', '✅ Registro ' . strtolower($asistencia->estado) . ' correctamente.');
    }
}
