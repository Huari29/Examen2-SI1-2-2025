<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaAcademica extends Model
{
    use HasFactory;

    protected $table = 'auditoria_academica';
    protected $primaryKey = 'id_auditoria';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitante',
        'descripcion',
        'fecha_solicitud',
        'estado',
        'atendido_por',
        'respuesta',
    ];

    // Relación con el usuario solicitante
    public function solicitante()
    {
        return $this->belongsTo(Usuario::class, 'id_solicitante', 'id_usuario');
    }

    // Relación con el usuario que atendió (opcional)
    public function atendidoPor()
    {
        return $this->belongsTo(Usuario::class, 'atendido_por', 'id_usuario');
    }
}
