<?php

namespace App\Http\Livewire;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use Livewire\Component;

class ProyectoPresupuestos2Component extends Component
{
    public $proyecto = null;
    public $presupuestos = null;
    public $showModal = false;
    public $descripcion = '';
    public $monto = 0;
    public $presupuesto_id = null;

    public function mount($id)
    {
        // Cargar el proyecto y sus presupuestos
        $this->proyecto = Proyecto::findOrFail($id);
        $this->presupuestos = $this->proyecto->presupuestos;
    }

    public function render()
    {
        return view('livewire.proyecto-presupuestos2-component');
    }

    public function guardar()
    {
        if ($this->presupuesto_id != null) {
            $item = Presupuesto::find($this->presupuesto_id); // Actualizar un presupuesto existente
        } else {
            $item = new Presupuesto(); // Crear un nuevo presupuesto
        }
    
        $item->descripcion = $this->descripcion;
        $item->monto = $this->monto;
        $item->proyecto_id = $this->proyecto->id;
    
        $item->save();
    
        $this->limpiarCampos();
        $this->showModal = false;
        $this->presupuestos = $this->proyecto->presupuestos; // Actualizar la lista de presupuestos
    }

    public function limpiarCampos()
    {
        $this->reset('presupuesto_id', 'descripcion', 'monto');
    }

    public function setItem($id)
    {
        $item = Presupuesto::find($id);
        $this->descripcion = $item->descripcion;
        $this->monto = $item->monto;
        $this->showModal = true;
        $this->presupuesto_id = $id;
    }

    public function cerrarModal()
    {
        $this->limpiarCampos(); // Limpia los campos
        $this->showModal = false; // Cierra el modal
    }

    public function eliminarPresupuesto($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->delete();

        // Actualizar la lista de presupuestos
        $this->presupuestos = $this->proyecto->presupuestos;
        session()->flash('success', 'Presupuesto eliminado exitosamente.');
    }
}
