<?php

namespace App\Http\Livewire;

use App\Models\Proyecto;
use App\Models\Riesgo;
use Livewire\Component;

class ProyectoRiesgosComponent extends Component
{
    public $proyecto = null;
    public $riesgos = null;
    public $showModal = false;
    public $descripcion = '';
    public $tipo = '';
    public $impacto = ''; 
    public $riesgo_id = null;

    public function mount($id)
    {
        $this->proyecto = Proyecto::findOrFail($id);
        $this->riesgos = $this->proyecto->riesgos;
    }

    public function render()
    {
        return view('livewire.proyecto-riesgos-component');
    }

    public function guardar()
    {
        if ($this->riesgo_id != null) {
            $item = Riesgo::find($this->riesgo_id);
        } else {
            $item = new Riesgo();
        }
    
        $item->descripcion = $this->descripcion;
        $item->tipo = $this->tipo;
        $item->impacto = $this->impacto; // Ahora acepta "positivo" o "negativo"
        $item->proyecto_id = $this->proyecto->id;
    
        $item->save();
    
        $this->limpiarCampos();
        $this->showModal = false;
        $this->riesgos = $this->proyecto->riesgos;
    }
    



    public function limpiarCampos()
    {
        $this->reset('riesgo_id', 'tipo', 'descripcion', 'impacto');
    }

    public function setItem($id)
    {
        $item = Riesgo::find($id);
        $this->descripcion = $item->descripcion;
        $this->tipo = $item->tipo;
        $this->impacto = $item->impacto;
        $this->showModal = true;
        $this->riesgo_id = $id;
    }

    public function cerrarModal()
    {
        $this->limpiarCampos(); // Limpia los campos
        $this->showModal = false; // Cierra el modal
    }

    public function eliminarRiesgo($id)
    {
        $riesgo = Riesgo::findOrFail($id);
        $riesgo->delete();

        // Actualizar la lista de riesgos
        $this->riesgos = $this->proyecto->riesgos;
        session()->flash('success', 'Riesgo eliminado exitosamente.');
    }
}
