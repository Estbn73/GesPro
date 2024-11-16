<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;

class TareasProyectoModal extends Component
{
    public $proyecto; // Proyecto seleccionado
    public $tareas = []; // Tareas asociadas al proyecto

    public function mount($proyecto)
    {
        $this->proyecto = $proyecto;
        $this->tareas = $proyecto->tareas; // Relación tareas del modelo Proyecto
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        if ($tarea) {
            $tarea->estado = !$tarea->estado; // Cambia el estado (0 -> 1 o 1 -> 0)
            $tarea->save();
        }

        // Actualiza la lista de tareas en el frontend
        $this->tareas = $this->proyecto->tareas;
    }

    public function render()
    {
        return view('livewire.tareas-proyecto-modal');
    }
}
