<?php
namespace App\Http\Livewire;

use App\Models\Proyecto;
use Livewire\Component;

class CrearProyectoModal extends Component
{
    public $nombre = '';
    public $descripcion = '';
    public $fecha_inicio = '';
    public $fecha_final = '';
    public $estado = 0; // Valor predeterminado
    public $showModal = false; // Control del modal

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:500',
        'fecha_inicio' => 'required|date',
        'fecha_final' => 'required|date|after_or_equal:fecha_inicio',
        'estado' => 'required|boolean',
    ];

    public function abrirModal()
    {
        $this->showModal = true;
    }

    public function cerrarModal()
    {
        $this->reset('nombre', 'descripcion', 'fecha_inicio', 'fecha_final', 'estado');
        $this->showModal = false;
    }

    public function guardarProyecto()
    {
        $this->validate();

        Proyecto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
            'estado' => $this->estado,
        ]);

        $this->cerrarModal();

        // Recargar la página para mostrar el nuevo proyecto
        return redirect()->route('proyectos.index');
    }

    public function render()
    {
        return view('livewire.crear-proyecto-modal');
    }
}
