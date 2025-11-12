<?php

namespace App\Livewire\Horarios;

use Livewire\Component;
use App\Models\DetalleHorario;
use App\Models\MateriaGrupo;
use App\Models\Aula;
use App\Models\Usuario;
use Carbon\Carbon;

class AsignarHorario extends Component
{
    public $materia_grupo_id;
    public $docente_id;
    public $aula_id;
    public $dia_semana;
    public $hora_inicio;
    public $hora_fin;
    public $gestion = '2025-1';

    public $materias;
    public $aulas;
    public $docentes;

    public function mount()
    {
        $this->materias = MateriaGrupo::with('materia', 'grupo')->get();
        $this->aulas = Aula::where('activo', true)->get();
        $this->docentes = Usuario::whereHas('rol', fn($q) => $q->where('nombre', 'Docente'))->get();
    }

    public function asignarHorario()
    {
        $this->validate([
            'materia_grupo_id' => 'required|exists:materia_grupo,id_mg',
            'docente_id' => 'required|exists:usuario,id',
            'aula_id' => 'required|exists:aula,id_aula',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

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
            session()->flash('error', '⚠️ Conflicto detectado: aula o docente ocupado.');
            return;
        }

        DetalleHorario::create([
            'creado_en' => Carbon::now(),
            'dia_semana' => $this->dia_semana,
            'estado' => 'Activo',
            'gestion' => $this->gestion,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'id_docente' => $this->docente_id,
            'id_aula' => $this->aula_id,
            'id_materia_grupo' => $this->materia_grupo_id,
        ]);

        session()->flash('success', '✅ Horario asignado correctamente.');
        $this->reset(['materia_grupo_id', 'docente_id', 'aula_id', 'dia_semana', 'hora_inicio', 'hora_fin']);
    }

    public function render()
    {
        return view('gestion-academica.asignar-horario.show', [
        'materias' => $this->materias,
        'aulas' => $this->aulas,
        'docentes' => $this->docentes,
    ]);

    }
}
