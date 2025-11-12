<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaValidacionController extends Controller
{
    public function index()
    {
        // 🔹 Mostrar asistencias pendientes de validación
        $asistencias = Asistencia::with(['detalle.materiaGrupo.docente', 'detalle.aula', 'detalle.horario'])
            ->where('estado', 'Pendiente')
            ->orderByDesc('fecha')
            ->get();

        return view('asistencia-docente.validar-asistencias.validar', compact('asistencias'));
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);

        $request->validate([
            'accion' => 'required|in:validar,rechazar',
            'observacion' => 'nullable|string|max:255',
        ]);

        if ($request->accion === 'validar') {
            $asistencia->estado = 'Validada';
        } else {
            $asistencia->estado = 'Rechazada';
            $asistencia->observacion = $request->observacion;
        }

        $asistencia->save();

        return redirect()->route('asistencias.validar.index')
            ->with('success', '✅ Asistencia ' . strtolower($asistencia->estado) . ' correctamente.');
    }
}
