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

        // Solo mostrar materias del docente autenticado
        $materias = MateriaGrupo::with(['materia', 'grupo'])
            ->where('id_docente', $usuario->id_usuario)
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
        $diaActual = $now->locale('es')->dayName; // Ej: lunes
        $horaActual = $now->format('H:i');

        // Buscar si el docente tiene clase en este momento
        $detalle = DetalleHorario::where('id_mg', $request->id_mg)
            ->where('dia_semana', ucfirst($diaActual))
            ->whereHas('horario', function ($query) use ($horaActual) {
                $query->where('hora_inicio', '<=', $horaActual)
                      ->where('hora_fin', '>=', $horaActual);
            })
            ->first();

        if (!$detalle) {
            return back()->with('error', '❌ No tienes una clase asignada en este momento.');
        }

        Asistencia::create([
            'creado_en' => $now,
            'fecha' => $now->toDateString(),
            'metodo_registro' => $request->metodo_registro,
            'observacion' => $request->observacion,
            'registrada_por' => Auth::id(),
            'id_detalle' => $detalle->id_detalle,
        ]);

        return back()->with('success', '✅ Asistencia registrada correctamente.');
    }
}
