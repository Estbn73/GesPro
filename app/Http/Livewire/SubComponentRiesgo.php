<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Riesgo;

class SubComponentRiesgo extends Component
{
    public $proyectoId;
    public $riesgos;
    public $nuevoRiesgo = [
        'tipo' => '',
        'descripcion' => '',
        'impacto' => '',
    ];
    public $mostrarFormulario = false; // Control para mostrar u ocultar el formulario

    public function mount($proyectoId)
    {
        $this->proyectoId = $proyectoId;
        $this->cargarRiesgos();
    }

    public function cargarRiesgos()
    {
        $this->riesgos = Riesgo::where('proyecto_id', $this->proyectoId)->get();
    }

    public function agregarRiesgo()
    {
        $this->validate([
            'nuevoRiesgo.tipo' => 'required|string|max:50',
            'nuevoRiesgo.descripcion' => 'required|string|max:255',
            'nuevoRiesgo.impacto' => 'required|in:positivo,negativo',
        ]);

        Riesgo::create([
            'tipo' => $this->nuevoRiesgo['tipo'],
            'descripcion' => $this->nuevoRiesgo['descripcion'],
            'impacto' => $this->nuevoRiesgo['impacto'],
            'proyecto_id' => $this->proyectoId,
        ]);

        $this->nuevoRiesgo = [
            'tipo' => '',
            'descripcion' => '',
            'impacto' => '',
        ];

        $this->mostrarFormulario = false; // Cerrar el formulario después de agregar
        $this->cargarRiesgos();
    }

    public function render()
    {
        return view('livewire.sub-component-riesgo', [
            'riesgos' => $this->riesgos,
        ]);
    }
}
