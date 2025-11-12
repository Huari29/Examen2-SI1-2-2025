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
        'registrada_por',
        'observacion',
        'creado_en',
    ];

    // 🔹 Relación con detalle_horario
    public function detalleHorario()
    {
        return $this->belongsTo(DetalleHorario::class, 'id_detalle', 'id_detalle');
    }

    // 🔹 Relación con el usuario que registró la asistencia
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'registrada_por', 'id_usuario');
    }

    // 🔹 Acceso rápido al docente desde el detalle
    public function docente()
    {
        return $this->detalle?->materiaGrupo?->docente;
    }

    // 🔹 Acceso rápido al aula
    public function aula()
    {
        return $this->detalle?->aula;
    }

    // 🔹 Acceso rápido al horario
    public function horario()
    {
        return $this->detalle?->horario;
    }
    
}
