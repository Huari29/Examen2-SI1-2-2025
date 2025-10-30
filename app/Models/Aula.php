<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'aula';
    protected $primaryKey = 'id_aula';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'capacidad',
        'ubicacion',
        'activo',
        'creado_en',
    ];

    // Aquí se podrían agregar relaciones futuras, por ejemplo con horarios o reservas
}
