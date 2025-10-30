<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSistema extends Model
{
    use HasFactory;

    protected $table = 'log_sistema';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'modulo',
        'accion',
        'descripcion',
        'ip',
        'navegador',
        'creado_en',
    ];

    // Relación opcional con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
    protected $casts = [
        'creado_en' => 'datetime',
    ];
    
    protected $dates = ['creado_en'];

}
