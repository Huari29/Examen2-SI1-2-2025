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

    // 🔹 Relación con aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula', 'id_aula');
    }

    // 🔹 Relación con materia_grupo
    public function materiaGrupo()
    {
        return $this->belongsTo(MateriaGrupo::class, 'id_mg', 'id_mg');
    }

    // 🔹 Relación con horario
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    }

    // 🔹 Acceso indirecto al docente a través de materia_grupo
    public function docente()
    {
        return $this->materiaGrupo ? $this->materiaGrupo->docente : null;
    }
}
