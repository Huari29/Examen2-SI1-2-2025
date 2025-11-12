<?php

namespace App\Http\Controllers;

use App\Models\DetalleHorario;
use App\Models\MateriaGrupo;
use App\Models\Aula;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HorarioController extends Controller
{
    public function create()
{
    $materias = \App\Models\Materia::all();
    $grupos = \App\Models\Grupo::all();
    $docentes = \App\Models\Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
    $aulas = \App\Models\Aula::where('activo', true)->get();

    return view('gestion-academica.asignar-horarios.show', compact('materias','grupos','docentes','aulas'));
}

public function store(Request $request)
{
    $request->validate([
        'id_materia' => 'required|exists:materia,id_materia',
        'id_grupo' => 'required|exists:grupo,id_grupo',
        'id_docente' => 'required|exists:usuario,id_usuario',
        'id_aula' => 'required|exists:aula,id_aula',
        'dias' => 'required|array|min:1',
        'hora_inicio' => 'required',
        'hora_fin' => 'required|after:hora_inicio',
        'gestion' => 'required|string',
    ]);

    foreach ($request->dias as $dia) {
        $conflicto = \App\Models\DetalleHorario::where('dia_semana', $dia)
            ->where(function ($q) use ($request) {
                $q->where('id_aula', $request->id_aula)
                  ->orWhere('id_docente', $request->id_docente);
            })
            ->where(function ($q) use ($request) {
                $q->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
            })
            ->exists();

        if ($conflicto) {
            return back()->with('error', "⚠️ Conflicto detectado en $dia: aula o docente ocupado.")->withInput();
        }

        \App\Models\DetalleHorario::create([
            'dia_semana' => $dia,
            'estado' => 'Activo',
            'gestion' => $request->gestion,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'id_docente' => $request->id_docente,
            'id_aula' => $request->id_aula,
            'id_materia_grupo' => \App\Models\MateriaGrupo::where('id_materia',$request->id_materia)
                                ->where('id_grupo',$request->id_grupo)
                                ->value('id_mg'),
            'creado_en' => now(),
        ]);
    }

    return redirect()->route('detalle-horario.create')->with('success', '✅ Horario asignado correctamente.');
}

}
