<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;

class TareasComponent extends Component
{
    public $proyectoId;
    public $tareas;
    public $tareaSeleccionada;

    protected $listeners = ['refreshTareas' => '$refresh'];

    public function mount($proyectoId)
    {
        $this->proyectoId = $proyectoId;
        $this->cargarTareas();
    }

    public function cargarTareas()
    {
        $this->tareas = Tarea::where('proyecto_id', $this->proyectoId)->get();
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);
        if ($tarea) {
            $tarea->estado = !$tarea->estado;
            $tarea->save();
            $this->cargarTareas();
        }
    }

    public function verMasTarea($tareaId)
    {
        $this->tareaSeleccionada = $this->tareaSeleccionada === $tareaId ? null : $tareaId;
    }

    public function render()
    {
        return view('livewire.tareas-component');
    }
}
