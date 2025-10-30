<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ⚠️ Cambiado
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'contrasenia',
        'id_rol',
        'activo',
        'creado_en',
        'actualizado_en',
        'ultimo_login',
    ];

    // Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    // Indica a Laravel qué campo es la contraseña
    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

    // Opcional: para recuperar contraseña usando 'correo'
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }
    public function initials()
{
    $words = explode(' ', $this->nombre);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return $initials;
}

}
