<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use App\Models\Document;

class TareasProyectoModal extends Component
{
    public $proyecto; 
    public $mostrarTodasTareas = false; 
    public $contadorTareasPendientes = 0; // Contador de tareas pendientes
    public $tareaSeleccionada = null; // Tarea seleccionada para ver más

    protected $listeners = ['actualizarContador']; 

    public function mount($proyecto)
    {
        $this->proyecto = $proyecto;
        $this->actualizarContador();
    }

    public function actualizarContador()
    {
        $this->contadorTareasPendientes = Tarea::where('proyecto_id', $this->proyecto->id)
            ->where('user_id', auth()->id()) 
            ->where('estado', 0) 
            ->count();
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        if ($tarea && $tarea->user_id == auth()->id()) { 
            $tarea->estado = !$tarea->estado; 
            $tarea->save();
        }

        $this->actualizarContador(); 
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
        $tareas = Tarea::where('proyecto_id', $this->proyecto->id)
            ->where('user_id', auth()->id()) // Filtrar por usuario autenticado
            ->when(!$this->mostrarTodasTareas, function ($query) {
                return $query->take(3); 
            })
            ->get();

        $documentos = $this->proyecto->documentos;

        return view('livewire.tareas-proyecto-modal', [
            'tareas' => $tareas,
            'documentos' => $documentos,
        ]);
    }
    
    
}
