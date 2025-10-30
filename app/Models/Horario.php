<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'descripcion',
        'creado_en',
    ];

    // Aquí se podrían agregar relaciones futuras con otras tablas, como asignaciones de materia_grupo
}
