<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Materia;
use Illuminate\Validation\Rule;

class Materias extends Component
{
    public $materias, $codigo, $nombre, $carga_horaria, $gestion_default, $activo, $materia_id;
    public $updateMode = false;

    public function render()
    {
        $this->materias = Materia::all();
        return view('livewire.materias');
    }

    public function resetInput()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->carga_horaria = '';
        $this->gestion_default = null;
        $this->activo = 1;
        $this->materia_id = null;
    }

    public function store()
    {
        $this->validate([
            'codigo' => ['required', Rule::unique('materia','codigo')->ignore($this->materia_id, 'id_materia')],
            'nombre' => ['required', Rule::unique('materia','nombre')->ignore($this->materia_id, 'id_materia')],
            'carga_horaria' => 'required|integer|min:1',
        ]);

        Materia::updateOrCreate(['id_materia' => $this->materia_id], [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'carga_horaria' => $this->carga_horaria,
            'gestion_default' => $this->gestion_default ?? '2025', // valor por defecto si es null
            'activo' => $this->activo,
        ]);

        session()->flash('message', $this->materia_id ? 'Materia actualizada.' : 'Materia creada.');

        $this->resetInput();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        $this->materia_id = $id;
        $this->codigo = $materia->codigo;
        $this->nombre = $materia->nombre;
        $this->carga_horaria = $materia->carga_horaria;
        $this->gestion_default = $materia->gestion_default;
        $this->activo = $materia->activo;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        Materia::findOrFail($id)->delete();
        session()->flash('message', 'Materia eliminada.');
    }
}
