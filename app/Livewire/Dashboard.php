<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $seccion = null;

    public function seleccionar($seccion)
    {
        $this->seccion = $seccion;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
