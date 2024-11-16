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
    public function mount($id){
        $this->proyecto = Proyecto::find($id);
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
        $item->save();
        $this->limpiarCampos();
        $this->showModal = false;
        $this->tareas = $this->proyecto->tareas;
    }

    public function limpiarCampos() {
        $this->reset('tarea_id','nombre_tarea','descripcion');
    }

    public function setItem($id){
        $item = Tarea::find($id);
        $this->descripcion = $item->descripcion;
        $this->nombre_tarea = $item->nombre_tarea;
        $this->showModal = true;
        $this->tarea_id= $id;
    }

}
