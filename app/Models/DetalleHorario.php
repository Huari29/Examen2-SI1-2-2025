<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleHorario extends Model
{
    use HasFactory;

    protected $table = 'detalle_horario';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_mg',
        'id_aula',
        'id_horario',
        'dia_semana',
        'gestion',
        'estado',
        'creado_en',
    ];

    // Relación con MateriaGrupo
    public function materiaGrupo()
    {
        return $this->belongsTo(MateriaGrupo::class, 'id_mg', 'id_mg');
    }

    // Relación con Aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula', 'id_aula');
    }

    // Relación con Horario
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    }
    // -------------------------------
    // 1️⃣ Función para verificar conflicto
    // -------------------------------
    public static function verificarConflicto($id_aula, $id_docente, $id_horario, $dia_semana)
    {
        // Conflicto con el aula
        $conflictoAula = self::where('id_aula', $id_aula)
            ->where('id_horario', $id_horario)
            ->where('dia_semana', $dia_semana)
            ->exists();

        if ($conflictoAula) {
            return 'Aula ocupada';
        }

        // Conflicto con el docente
        $conflictoDocente = self::whereHas('materiaGrupo', function($q) use ($id_docente) {
            $q->where('id_docente', $id_docente);
        })
        ->where('id_horario', $id_horario)
        ->where('dia_semana', $dia_semana)
        ->exists();

        if ($conflictoDocente) {
            return 'Docente ocupado';
        }

        return false; // Sin conflictos
    }
}
