<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InformacionProyectoComponent extends Component
{
    public $proyecto;

    public function mount($proyecto)
    {
        $this->proyecto = $proyecto;
    }

    public function render()
    {
        return view('livewire.informacion-proyecto-component');
    }
}
