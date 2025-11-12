<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class NotificacionInconsistencias extends Component
{
    public $pendientes = 0;

    public function mount()
    {
        $usuario = Auth::user();

        if ($usuario->rol->nombre === 'Docente') {
            $this->pendientes = Asistencia::whereIn('estado', ['Inconsistente', 'Falta'])
                ->whereHas('detalleHorario.materiaGrupo', fn($q) => $q->where('id_docente', $usuario->id_usuario))
                ->count();
        } elseif ($usuario->rol->nombre === 'Administrador') {
            $this->pendientes = Asistencia::whereIn('estado', ['Inconsistente', 'Resuelta', 'Falta'])->count();
        }
    }

    public function render()
    {
        return view('livewire.notificacion-inconsistencias');
    }
}
