<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuracion';
    protected $primaryKey = 'clave';
    public $incrementing = false; // Porque la PK no es auto-incremental
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'clave',
        'valor',
        'descripcion',
        'actualizado_en',
    ];
}
