<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\MateriaGrupo;
use Illuminate\Validation\Rule;

class MateriaGrupos extends Component
{
    public $materias, $grupos, $materiaGrupos;
    public $id_materia, $id_grupo, $id_mg;
    public $updateMode = false;

    public function mount()
    {
        $this->materias = Materia::where('activo',1)->get();
        $this->grupos = Grupo::where('activo',1)->get();
    }

    public function render()
    {
        $this->materiaGrupos = MateriaGrupo::with('materia','grupo')->get();
        return view('livewire.materia-grupos');
    }

    public function resetInput()
    {
        $this->id_materia = '';
        $this->id_grupo = '';
        $this->id_mg = null;
    }

    public function store()
    {
        $this->validate([
            'id_materia' => 'required',
            'id_grupo' => [
                'required',
                Rule::unique('materia_grupo')->where(function($query){
                    return $query->where('id_materia', $this->id_materia);
                })->ignore($this->id_mg, 'id_mg'),
            ],
        ]);

        MateriaGrupo::updateOrCreate(['id_mg' => $this->id_mg], [
            'id_materia' => $this->id_materia,
            'id_grupo' => $this->id_grupo,
        ]);

        session()->flash('message', $this->id_mg ? 'Asignación actualizada.' : 'Asignación creada.');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $mg = MateriaGrupo::findOrFail($id);
        $this->id_mg = $id;
        $this->id_materia = $mg->id_materia;
        $this->id_grupo = $mg->id_grupo;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        MateriaGrupo::findOrFail($id)->delete();
        session()->flash('message', 'Asignación eliminada.');
    }
}
