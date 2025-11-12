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

    // 🔹 Buscar o crear la relación materia-grupo-docente
    $materiaGrupo = \App\Models\MateriaGrupo::firstOrCreate([
        'id_materia' => $request->id_materia,
        'id_grupo' => $request->id_grupo,
        'id_docente' => $request->id_docente,
        'gestion' => $request->gestion,
    ], [
        'activo' => true,
        'creado_en' => now(),
    ]);

    // 🔹 Crear un registro de horario por cada día seleccionado
    foreach ($request->dias as $dia) {
        \App\Models\DetalleHorario::create([
            'creado_en' => now(),
            'dia_semana' => $dia,
            'estado' => 'Activo',
            'gestion' => $request->gestion,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'id_aula' => $request->id_aula,
            'id_mg' => $materiaGrupo->id_mg, // 🔗 clave foránea
        ]);
    }

    return redirect()
        ->route('detalle-horario.create')
        ->with('success', '✅ Horarios asignados correctamente.');
}

}
