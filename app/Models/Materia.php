<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materia';
    protected $primaryKey = 'id_materia';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'carga_horaria',
        'gestion_default',
        'activo',
        'creado_en',
        'actualizado_en',
    ];

    // Aquí se pueden agregar relaciones, por ejemplo con materia_grupo
    public function materiaGrupos()
    {
        return $this->hasMany(MateriaGrupo::class, 'id_materia', 'id_materia');
    }
}
