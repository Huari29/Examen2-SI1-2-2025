<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriaGrupo;
use App\Models\DetalleHorario;
use App\Models\Aula;
use App\Models\Horario;
use App\Models\Usuario;

class HorarioController extends Controller
{
    public function create()
    {
        $materias = \App\Models\Materia::all();
        $grupos = \App\Models\Grupo::all();
        $docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
        $aulas = Aula::where('activo', true)->get();
        $horarios = Horario::all(); // 👈 los bloques de horarios predefinidos

        return view('gestion-academica.asignar-horario.show', compact(
            'materias', 'grupos', 'docentes', 'aulas', 'horarios'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_materia' => 'required|exists:materia,id_materia',
            'id_grupo' => 'required|exists:grupo,id_grupo',
            'id_docente' => 'required|exists:usuario,id_usuario',
            'id_aula' => 'required|exists:aula,id_aula',
            'id_horario' => 'required|exists:horario,id', // 👈 referencia a horario
            'dias' => 'required|array|min:1',
            'gestion' => 'required|string',
        ]);

        // Buscar o crear materia_grupo
        $materiaGrupo = MateriaGrupo::firstOrCreate([
            'id_materia' => $request->id_materia,
            'id_grupo' => $request->id_grupo,
            'id_docente' => $request->id_docente,
            'gestion' => $request->gestion,
        ], [
            'activo' => true,
            'creado_en' => now(),
        ]);

        // Crear un detalle por cada día
        foreach ($request->dias as $dia) {
            DetalleHorario::create([
                'creado_en' => now(),
                'dia_semana' => $dia,
                'estado' => 'Activo',
                'gestion' => $request->gestion,
                'id_horario' => $request->id_horario, // 👈 FK hacia horario
                'id_aula' => $request->id_aula,
                'id_mg' => $materiaGrupo->id_mg,
            ]);
        }

        return redirect()->route('detalle-horario.create')->with('success', '✅ Horario asignado correctamente.');
    }
}
