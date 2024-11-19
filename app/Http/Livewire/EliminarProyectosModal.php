<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proyecto;

class EliminarProyectosModal extends Component
{
    public $proyectos; // Almacena los proyectos
    public $proyectoSeleccionado; // ID del proyecto seleccionado para eliminar
    public $showModal = false; // Controla la visibilidad del modal

    protected $listeners = ['abrirModalEliminar'];

    public function abrirModalEliminar()
    {
        $this->showModal = true;
        $this->cargarProyectos();
    }

    public function cargarProyectos()
    {
        $this->proyectos = Proyecto::all();
    }

    public function eliminarProyecto($id)
    {
        $proyecto = Proyecto::find($id);

        if ($proyecto) {
            $proyecto->delete();
            $this->cargarProyectos(); // Actualiza la lista tras la eliminación
            session()->flash('message', '¡Proyecto eliminado correctamente!');
        } else {
            session()->flash('error', 'No se pudo encontrar el proyecto.');
        }
    }

    public function cerrarModal()
    {
        $this->showModal = false;
        $this->reset(['proyectos', 'proyectoSeleccionado']); // Resetea datos
        return redirect()->route('proyectos.index');

    }

    public function render()
    {
        return view('livewire.eliminar-proyectos-modal');
    }
}
