<?php

namespace App\Http\Livewire;

use App\Models\Riesgo;
use App\Models\Proyecto;
use Livewire\Component;

class ProyectoRiesgoComponent extends Component
{
    public $proyecto;
    public $tipo, $descripcion, $impacto;
    public $selectedRiesgo = null;

    protected $rules = [
        'tipo' => 'required|string',
        'descripcion' => 'required|string',
        'impacto' => 'required|integer|min:1|max:5',
    ];

    public function mount(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
    }

    public function render()
    {
        return view('livewire.proyecto-riesgo-component', [
            'riesgos' => $this->proyecto->riesgos,
        ]);
    }

    public function resetForm()
    {
        $this->tipo = null;
        $this->descripcion = null;        
        $this->impacto = null;
        $this->selectedRiesgo = null;
    }

    public function store()
    {
        $this->validate();
        
        $this->proyecto->riesgos()->create([
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'impacto' => $this->impacto,
        ]);

        session()->flash('message', 'Riesgo creado exitosamente.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $riesgo = Riesgo::findOrFail($id);
        $this->selectedRiesgo = $riesgo; // Almacena el modelo completo en lugar del id
        $this->tipo = $riesgo->tipo;
        $this->descripcion = $riesgo->descripcion;
        $this->impacto = $riesgo->impacto;
    }
        
    public function update()
    {
        if ($this->selectedRiesgo) {
            $this->validate();

            // Actualiza el riesgo seleccionado
            $this->selectedRiesgo->update([
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
                'impacto' => $this->impacto,
            ]);

            session()->flash('message', 'Riesgo actualizado exitosamente.');
            $this->resetForm();
        }
    }

    public function delete($id)
    {
        $riesgo = Riesgo::findOrFail($id);
        $riesgo->delete();
    
        session()->flash('message', 'Riesgo eliminado exitosamente.');
        $this->resetForm(); // Si tienes un método para resetear el formulario
    }
    
}
