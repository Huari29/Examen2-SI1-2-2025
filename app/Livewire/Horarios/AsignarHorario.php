<?php

namespace App\Livewire\Horarios;

use Livewire\Component;
use App\Models\DetalleHorario;
use App\Models\MateriaGrupo;
use App\Models\Aula;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AsignarHorario extends Component
{
    public $materia_grupo_id;
    public $docente_id;
    public $aula_id;
    public $dia_semana;
    public $hora_inicio;
    public $hora_fin;

    public $materias;
    public $aulas;
    public $docentes;

    public $mensaje = '';

    public function mount()
    {
        $this->materias = MateriaGrupo::all();
        $this->aulas = Aula::where('activo', true)->get();
        $this->docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
    }

    public function asignarHorario()
    {
        $conflicto = DetalleHorario::where('dia_semana', $this->dia_semana)
            ->where(function ($q) {
                $q->where('id_aula', $this->aula_id)
                  ->orWhere('id_docente', $this->docente_id);
            })
            ->where(function ($q) {
                $q->whereBetween('hora_inicio', [$this->hora_inicio, $this->hora_fin])
                  ->orWhereBetween('hora_fin', [$this->hora_inicio, $this->hora_fin]);
            })
            ->exists();

        if ($conflicto) {
            $this->mensaje = "⚠️ Conflicto detectado: aula o docente ocupado.";
            return;
        }

        DetalleHorario::create([
            'creado_en' => Carbon::now(),
            'dia_semana' => $this->dia_semana,
            'gestion' => '2025',
            'estado' => 'Activo',
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'id_docente' => $this->docente_id,
            'id_aula' => $this->aula_id,
            'id_materia_grupo' => $this->materia_grupo_id,
        ]);

        $this->mensaje = "✅ Horario asignado correctamente.";
        $this->reset(['materia_grupo_id', 'docente_id', 'aula_id', 'dia_semana', 'hora_inicio', 'hora_fin']);
    }

    public function render()
    {
        return view('gestion-academica.asignar-horarios.show');
    }
}
