<?php

namespace App\Http\Livewire;

use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;

class ProyectoTareasComponent extends Component
{
    public $proyecto = null;
    public $tareas = null;
    public $showModal = false;
    public $descripcion = '';
    public $nombre_tarea = '';
    public $fecha_inicio = ''; 
    public $fecha_final = '';  
    public $tarea_id = null;
    public $user_id = null;

    public function mount($id)
    {
        $this->proyecto = Proyecto::findOrFail($id);
        $this->tareas = $this->proyecto->tareas;
    }

    public function render()
    {
        return view('livewire.proyecto-tareas-component');
    }

    public function guardar()
    {
        $this->validate([
            'nombre_tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($this->tarea_id != null) {
            $item = Tarea::find($this->tarea_id);
        } else {
            $item = new Tarea();
        }

        $item->descripcion = $this->descripcion;
        $item->nombre_tarea = $this->nombre_tarea;
        $item->proyecto_id = $this->proyecto->id;
        $item->user_id = $this->user_id;
        $item->fecha_inicio = $this->fecha_inicio; 
        $item->fecha_final = $this->fecha_final;  
        $item->save();

        $this->limpiarCampos();
        $this->showModal = false;
        $this->tareas = $this->proyecto->tareas;
    }

    public function limpiarCampos()
    {
        $this->reset('tarea_id', 'nombre_tarea', 'descripcion', 'fecha_inicio', 'fecha_final', 'user_id');
    }

    public function setItem($id)
    {
        $item = Tarea::find($id);
        $this->descripcion = $item->descripcion;
        $this->nombre_tarea = $item->nombre_tarea;
        $this->fecha_inicio = $item->fecha_inicio; 
        $this->fecha_final = $item->fecha_final;   
        $this->user_id = $item->user_id;
        $this->showModal = true;
        $this->tarea_id = $id;
    }

    public function cerrarModal()
    {
        $this->limpiarCampos();
        $this->showModal = false;
    }

    public function eliminarTarea($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        $this->tareas = $this->proyecto->tareas;
        session()->flash('success', 'Tarea eliminada exitosamente.');
    }
}
