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
        'creado_en',
        'dia_semana',
        'estado',
        'gestion',
        'hora_inicio',
        'hora_fin',
        'id_docente',
        'id_aula',
        'id_materia_grupo',
    ];

    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'id_docente');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }

    public function materiaGrupo()
    {
        return $this->belongsTo(MateriaGrupo::class, 'id_materia_grupo');
    }
}
