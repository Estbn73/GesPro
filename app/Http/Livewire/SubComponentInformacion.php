<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SubComponentInformacion extends Component
{
    public $proyecto;

    public function mount($proyecto = null)
    {
        $this->proyecto = $proyecto ?? [
            'nombre' => 'Proyecto de Prueba',
            'descripcion' => 'Descripción de prueba',
            'fecha_inicio' => now(),
            'fecha_final' => now()->addDays(30),
        ];
    }
    
    public function render()
    {
        return view('livewire.sub-component-informacion');
    }
}
