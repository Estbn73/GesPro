<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use App\Models\Document;

class TareasProyectoModal extends Component
{
    public $proyecto; // Proyecto seleccionado
    public $mostrarTodasTareas = false; 
    public $contadorTareasPendientes = 0; // Contador de tareas pendientes

    protected $listeners = ['actualizarContador']; // Escucha eventos específicos

    public function mount($proyecto)
    {
        $this->proyecto = $proyecto;
        $this->actualizarContador();
    }

    public function actualizarContador()
    {
        $this->contadorTareasPendientes = $this->proyecto->tareas->where('estado', 0)->count();
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        if ($tarea) {
            $tarea->estado = !$tarea->estado; // Cambia el estado
            $tarea->save();
        }

        // Actualiza el contador directamente
        $this->contadorTareasPendientes = $this->proyecto->tareas->where('estado', 0)->count();
    }

    public function mostrarTodas()
    {
        $this->mostrarTodasTareas = true; 
    }

    public function regresar()
    {
        $this->mostrarTodasTareas = false; 
    }

    public function render()
    {
        $tareas = $this->mostrarTodasTareas
            ? $this->proyecto->tareas 
            : $this->proyecto->tareas->take(3); // Solo las primeras 3 tareas

        $documentos = $this->proyecto->documentos;

        return view('livewire.tareas-proyecto-modal', [
            'tareas' => $tareas,
            'documentos' => $documentos,
        ]);
    }
}
