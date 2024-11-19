<?php

namespace App\Http\Livewire;

use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;
use App\Models\User; 

class ProyectoTareasComponent extends Component
{

    public $proyecto = null;
    public $tareas = null;
    public $showModal = false;
    public $descripcion = '';
    public $nombre_tarea = '';
    public $tarea_id = null;
    public $user_id = null;
    public $prioridad = 0; 

    public function mount($id){
        $this->proyecto = Proyecto::find($id);
        $this->tareas = $this->proyecto->tareas;
        
    }
    public function render()
    {
        return view('livewire.proyecto-tareas-component', [
            'usuarios' => User::all(),
        ]);
    }

    

    public function guardar()
    {
        $this->validate([
            'nombre_tarea' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'user_id' => 'nullable|exists:users,id',
            'prioridad' => 'boolean',
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
        $item->prioridad = $this->prioridad;
        $item->save();
    
        $this->limpiarCampos();
        $this->showModal = false;
        $this->tareas = $this->proyecto->tareas;
    }
    
    public function eliminarTarea($id)
    {
        // Buscar la tarea por ID
        $tarea = Tarea::find($id);

        if ($tarea) {
            $tarea->delete();
        }

        $this->tareas = $this->proyecto->tareas;

        session()->flash('message', 'Tarea eliminada correctamente.');
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
