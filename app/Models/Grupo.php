<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo';
    protected $primaryKey = 'id_grupo';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'turno',
        'gestion',
        'activo',
        'creado_en',
    ];

    // Relación con materia_grupo
    public function materiaGrupos()
    {
        return $this->hasMany(MateriaGrupo::class, 'id_grupo', 'id_grupo');
    }

    // Accesor opcional para mostrar activo como texto
    public function getActivoTextoAttribute()
    {
        return $this->activo ? 'Sí' : 'No';
    }
}
