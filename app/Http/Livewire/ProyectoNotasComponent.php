<?php

namespace App\Http\Livewire;

use App\Models\Nota;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProyectoNotasComponent extends Component
{
    public $proyecto = null;
    public $notas = null;
    public $showModal = false;
    public $contenido = '';
    public $nota_id = null;

    public function mount($id)
    {
        // Cargar el proyecto y sus notas
        $this->proyecto = Proyecto::findOrFail($id);
        $this->notas = $this->proyecto->notas;
        $this->notas = $this->proyecto->notas()->with('user')->get();
    }

    public function render()
    {
        return view('livewire.proyecto-notas-component');
    }

    public function guardar()
    {
        if ($this->nota_id != null) {
            $nota = Nota::find($this->nota_id); // Actualizar una nota existente
        } else {
            $nota = new Nota(); // Crear una nueva nota
        }

        $nota->contenido = $this->contenido;
        $nota->proyecto_id = $this->proyecto->id;
        $nota->user_id = Auth::id(); // Asignar el ID del usuario actual

        $nota->save();

        $this->limpiarCampos();
        $this->showModal = false;
        $this->notas = $this->proyecto->notas; // Actualizar la lista de notas
    }

    public function limpiarCampos()
    {
        $this->reset('nota_id', 'contenido');
    }

    public function setItem($id)
    {
        $nota = Nota::find($id);
        $this->contenido = $nota->contenido;
        $this->showModal = true;
        $this->nota_id = $id;
    }

    public function cerrarModal()
    {
        $this->limpiarCampos(); // Limpia los campos
        $this->showModal = false; // Cierra el modal
    }

    public function eliminarNota($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();

        // Actualizar la lista de notas
        $this->notas = $this->proyecto->notas;
        session()->flash('success', 'Nota eliminada exitosamente.');
    }
}
