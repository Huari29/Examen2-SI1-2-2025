<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aula;
use Illuminate\Validation\Rule;

class Aulas extends Component
{
    public $aulas, $codigo, $nombre, $capacidad, $ubicacion, $activo, $aula_id;
    public $updateMode = false;

    public function render()
    {
        $this->aulas = Aula::all();
        return view('livewire.aulas');
    }

    public function resetInput()
    {
        $this->codigo = '';
        $this->nombre = '';
        $this->capacidad = '';
        $this->ubicacion = '';
        $this->activo = 1;
        $this->aula_id = null;
    }

    public function store()
    {
        $this->validate([
            'codigo' => ['required', Rule::unique('aula','codigo')->ignore($this->aula_id, 'id_aula')],
            'nombre' => ['required', Rule::unique('aula','nombre')->ignore($this->aula_id, 'id_aula')],
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required',
        ]);

        Aula::updateOrCreate(['id_aula' => $this->aula_id], [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'capacidad' => $this->capacidad,
            'ubicacion' => $this->ubicacion,
            'activo' => $this->activo,
        ]);

        session()->flash('message', $this->aula_id ? 'Aula actualizada.' : 'Aula creada.');

        $this->resetInput();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $aula = Aula::findOrFail($id);
        $this->aula_id = $id;
        $this->codigo = $aula->codigo;
        $this->nombre = $aula->nombre;
        $this->capacidad = $aula->capacidad;
        $this->ubicacion = $aula->ubicacion;
        $this->activo = $aula->activo;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        Aula::findOrFail($id)->delete();
        session()->flash('message', 'Aula eliminada.');
    }
}
