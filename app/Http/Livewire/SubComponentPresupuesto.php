<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Presupuesto;

class SubComponentPresupuesto extends Component
{
    public $proyectoId;
    public $presupuesto;

    public function mount($proyectoId)
    {
        $this->proyectoId = $proyectoId;
        $this->cargarPresupuesto();
    }

    public function cargarPresupuesto()
    {
        $this->presupuesto = Presupuesto::where('proyecto_id', $this->proyectoId)->first();
    }

    public function render()
    {
        return view('livewire.sub-component-presupuesto', [
            'presupuesto' => $this->presupuesto,
        ]);
    }
}
