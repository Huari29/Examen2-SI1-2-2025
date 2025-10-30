<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaGrupo extends Model
{
    use HasFactory;

    protected $table = 'materia_grupo';
    protected $primaryKey = 'id_mg';
    public $timestamps = false;

    protected $fillable = [
        'id_materia',
        'id_grupo',
        'id_docente',
        'gestion',
        'activo',
        'creado_en',
    ];

    // Relaciones
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia', 'id_materia');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo', 'id_grupo');
    }

    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'id_docente', 'id_usuario');
    }

    // Accesor opcional para mostrar activo como texto
    public function getActivoTextoAttribute()
    {
        return $this->activo ? 'Sí' : 'No';
    }
}

