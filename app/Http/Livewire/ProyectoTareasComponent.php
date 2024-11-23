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
    public $tarea_id = null;
    public $user_id = null;
    public function mount($id){
        $this->proyecto = Proyecto::findOrFail($id);
        $this->tareas = $this->proyecto->tareas;
        
    }
    public function render()
    {
        return view('livewire.proyecto-tareas-component');
    }

    public function guardar(){
        if($this->tarea_id != null){
            $item = Tarea::find($this->tarea_id);
        } else {
            $item = new Tarea();
        }
        $item->descripcion = $this->descripcion;
        $item->nombre_tarea = $this->nombre_tarea;
        $item->proyecto_id = $this->proyecto->id;
        $item->user_id = $this->user_id;
        $item->save();
        $this->limpiarCampos();
        $this->showModal = false;
        $this->tareas = $this->proyecto->tareas;
    }

    public function limpiarCampos()
    {
        $this->reset('tarea_id', 'nombre_tarea', 'descripcion', 'user_id');
    }
    public function setItem($id){
        $item = Tarea::find($id);
        $this->descripcion = $item->descripcion;
        $this->nombre_tarea = $item->nombre_tarea;
        $this->user_id = $item->user_id;
        $this->showModal = true;
        $this->tarea_id= $id;
    }

    public function cerrarModal()
{
    $this->limpiarCampos(); // Limpia los campos
    $this->showModal = false; // Cierra el modal
}

public function eliminarTarea($id)
{
    $tarea = Tarea::findOrFail($id);
    $tarea->delete();

    // Actualizar la lista de tareas
    $this->tareas = $this->proyecto->tareas;
    session()->flash('success', 'Tarea eliminada exitosamente.');
}



}
