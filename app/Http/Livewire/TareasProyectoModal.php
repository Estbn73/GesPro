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
        $usuarioActual = auth()->user(); // Usuario autenticado
        $this->contadorTareasPendientes = $this->proyecto->tareas
            ->where('estado', 0)
            ->where('user_id', $usuarioActual->id)
            ->count();
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        if ($tarea && $tarea->user_id == auth()->id()) { // Verificar que la tarea pertenece al usuario actual
            $tarea->estado = !$tarea->estado;
            $tarea->save();
        }

        $this->actualizarContador(); // Actualiza el contador
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
        $usuarioActual = auth()->user(); // Usuario autenticado

        $tareas = $this->mostrarTodasTareas
            ? $this->proyecto->tareas->where('user_id', $usuarioActual->id) // Todas las tareas del usuario
            : $this->proyecto->tareas->where('user_id', $usuarioActual->id)->take(3); // Solo 3 tareas del usuario

        $documentos = $this->proyecto->documentos;

        return view('livewire.tareas-proyecto-modal', [
            'tareas' => $tareas,
            'documentos' => $documentos,
        ]);
    }
}