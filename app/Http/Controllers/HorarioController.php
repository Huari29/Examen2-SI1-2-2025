<?php

use App\Models\DetalleHorario;
use App\Models\MateriaGrupo;

class HorarioController extends Controller
{
    public function asignarHorario($id_mg, $id_aula, $id_horario, $dia_semana, $gestion)
    {
        $materiaGrupo = MateriaGrupo::findOrFail($id_mg);

        // Llamamos al método del modelo para verificar conflicto
        $conflicto = DetalleHorario::verificarConflicto($id_aula, $materiaGrupo->id_docente, $id_horario, $dia_semana);

        if ($conflicto) {
            return response()->json(['error' => $conflicto]);
        }

        // Si no hay conflicto, creamos el detalle
        $detalle = DetalleHorario::create([
            'id_mg' => $id_mg,
            'id_aula' => $id_aula,
            'id_horario' => $id_horario,
            'dia_semana' => $dia_semana,
            'gestion' => $gestion,
            'estado' => 'activo',
            'creado_en' => now(),
        ]);

        return response()->json(['success' => 'Horario asignado correctamente', 'detalle' => $detalle]);
    }
}
