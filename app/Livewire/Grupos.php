<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grupo;
use Illuminate\Validation\Rule;

class Grupos extends Component
{
    public $grupos, $codigo, $nombre, $turno, $gestion, $activo, $grupo_id;
    public $updateMode = false;

    public function render()
    {
        $this->grupos = Grupo::all();
        return view('livewire.grupos');
    }

    public function resetInput()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->turno = '';
        $this->gestion = '';
        $this->activo = 1;
        $this->grupo_id = null;
    }

    public function store()
    {
        $this->validate([
            'codigo' => ['required', Rule::unique('grupo','codigo')->ignore($this->grupo_id, 'id_grupo')],
            'nombre' => ['required', Rule::unique('grupo','nombre')->ignore($this->grupo_id, 'id_grupo')],
            'turno' => 'required',
            'gestion' => 'required',
        ]);

        Grupo::updateOrCreate(['id_grupo' => $this->grupo_id], [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'turno' => $this->turno,
            'gestion' => $this->gestion,
            'activo' => $this->activo,
        ]);

        session()->flash('message', $this->grupo_id ? 'Grupo actualizado.' : 'Grupo creado.');

        $this->resetInput();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        $this->grupo_id = $id;
        $this->codigo = $grupo->codigo;
        $this->nombre = $grupo->nombre;
        $this->turno = $grupo->turno;
        $this->gestion = $grupo->gestion;
        $this->activo = $grupo->activo;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        Grupo::findOrFail($id)->delete();
        session()->flash('message', 'Grupo eliminado.');
    }
}
