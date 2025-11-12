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
        $materiaGrupos = MateriaGrupo::with('materia', 'grupo', 'docente')->get();
        $aulas = Aula::where('activo', true)->get();
        $docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();

        return view('gestion-academica.asignar-horarios.show', compact('materiaGrupos', 'aulas', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_materia_grupo' => 'required|exists:materia_grupo,id_mg',
            'id_docente' => 'required|exists:usuario,id',
            'id_aula' => 'required|exists:aula,id_aula',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'gestion' => 'required|string',
        ]);

        $conflicto = DetalleHorario::where('dia_semana', $request->dia_semana)
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
            return back()->with('error', '⚠️ Conflicto detectado: aula o docente ocupado.')->withInput();
        }

        DetalleHorario::create([
            'creado_en' => Carbon::now(),
            'dia_semana' => $request->dia_semana,
            'estado' => 'Activo',
            'gestion' => $request->gestion,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'id_docente' => $request->id_docente,
            'id_aula' => $request->id_aula,
            'id_materia_grupo' => $request->id_materia_grupo,
        ]);

        return redirect()->route('detalle-horario.create')->with('success', '✅ Horario asignado correctamente.');
    }
}
