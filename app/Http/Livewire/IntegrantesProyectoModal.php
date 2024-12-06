<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EquipoProyecto;
use App\Models\User;

class IntegrantesProyectoModal extends Component
{
    public $proyectoId;

    public function render()
    {
        $integrantes = EquipoProyecto::where('proyecto_id', $this->proyectoId)
            ->with('usuario') // Relación con usuarios
            ->get();

        return view('livewire.integrantes-proyecto-modal', [
            'integrantes' => $integrantes,
        ]);
    }
}

