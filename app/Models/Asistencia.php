<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';
    protected $primaryKey = 'id_asistencia';
    public $timestamps = false;

    protected $fillable = [
        'id_detalle',
        'fecha',
        'estado',
        'metodo_registro',
        'registrado_por',
        'observacion',
        'creado_en',
    ];

    // Relación con DetalleHorario
    public function detalleHorario()
    {
        return $this->belongsTo(DetalleHorario::class, 'id_detalle', 'id_detalle');
    }

    // Relación con Usuario que registró la asistencia
    public function registradoPor()
    {
        return $this->belongsTo(Usuario::class, 'registrado_por', 'id_usuario');
    }
}
