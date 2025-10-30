<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluacion';
    protected $primaryKey = 'id_evaluacion';
    public $timestamps = false;

    protected $fillable = [
        'id_docente',
        'porcentaje',
        'gestion',
        'evaluado_por',
        'observacion',
        'creado_en',
    ];

    // Relación con el docente evaluado
    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'id_docente', 'id_usuario');
    }

    // Relación con el usuario que evaluó (opcional)
    public function evaluador()
    {
        return $this->belongsTo(Usuario::class, 'evaluado_por', 'id_usuario');
    }
}
