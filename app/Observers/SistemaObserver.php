<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\LogSistema;

class SistemaObserver
{
    protected $acciones = [
        'created' => 'CREAR',
        'updated' => 'ACTUALIZAR',
        'deleted' => 'ELIMINAR',
    ];

    public function created($model)
    {
        $this->registrar($model, 'created');
    }

    public function updated($model)
    {
        $this->registrar($model, 'updated');
    }

    public function deleted($model)
    {
        $this->registrar($model, 'deleted');
    }

    protected function registrar($model, $evento)
    {
        LogSistema::create([
            'id_usuario' => Auth::id() ?? null,
            'modulo' => class_basename($model),
            'accion' => $this->acciones[$evento] ?? $evento,
            'descripcion' => $this->descripcion($model, $evento),
            'ip' => Request::ip(),
            'navegador' => Request::header('User-Agent'),
            'creado_en' => now(),
        ]);
    }

    protected function descripcion($model, $evento)
    {
        $id = $model->getKey();
        switch ($evento) {
            case 'created':
                return "Se creó un nuevo registro con ID $id.";
            case 'updated':
                return "Se actualizó el registro con ID $id.";
            case 'deleted':
                return "Se eliminó el registro con ID $id.";
            default:
                return "Se realizó $evento sobre el registro con ID $id.";
        }
    }
}
