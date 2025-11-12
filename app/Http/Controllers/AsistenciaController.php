<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\MateriaGrupo;
use App\Models\DetalleHorario;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function create()
    {
        $usuario = Auth::user();
        $now = Carbon::now();
        $diaActual = ucfirst($now->locale('es')->dayName); // Ej: Lunes
        $horaActual = $now->format('H:i');

        // Materias del docente
        $materias = MateriaGrupo::with(['materia', 'grupo'])
            ->where('id_docente', $usuario->id_usuario)
            ->whereHas('detallesHorario.horario', function ($query) use ($diaActual, $horaActual) {
                $query->where('dia_semana', $diaActual)
                      ->where('hora_inicio', '<=', $horaActual)
                      ->where('hora_fin', '>=', $horaActual);
            })
            ->get();

        return view('asistencia-docente.registrar-asistencias.register', compact('materias'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_mg' => 'required|exists:materia_grupo,id_mg',
        'metodo_registro' => 'required|string',
        'observacion' => 'nullable|string',
    ]);

    $now = Carbon::now();
    $diaActual = ucfirst($now->locale('es')->dayName);
    $horaActual = $now->format('H:i');

    // Buscar si el docente tiene clase en este momento exacto
    $detalle = DetalleHorario::where('id_mg', $request->id_mg)
        ->where('dia_semana', $diaActual)
        ->whereHas('horario', function ($query) use ($horaActual) {
            $query->where('hora_inicio', '<=', $horaActual)
                  ->where('hora_fin', '>=', $horaActual);
        })
        ->first();

    // 🔹 Si no tiene clase en este momento, no puede registrar asistencia
    if (!$detalle) {
        return back()->with('error', '❌ No puedes registrar asistencia fuera de tu horario asignado.');
    }

    // Verificar si ya registró asistencia en este detalle hoy
    $asistenciaExistente = Asistencia::where('id_detalle', $detalle->id_detalle)
        ->whereDate('fecha', $now->toDateString())
        ->first();

    if ($asistenciaExistente) {
        return back()->with('error', '⚠️ Ya registraste asistencia para este horario.');
    }

    // Crear asistencia
    Asistencia::create([
        'creado_en' => $now,
        'fecha' => $now->toDateString(),
        'estado' => 'Pendiente',
        'metodo_registro' => $request->metodo_registro,
        'observacion' => $request->observacion,
        'registrada_por' => Auth::id(),
        'id_detalle' => $detalle->id_detalle,
    ]);

    return back()->with('success', '✅ Asistencia registrada correctamente.');
}

}
