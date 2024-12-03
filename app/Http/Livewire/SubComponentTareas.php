<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class SubComponentTareas extends Component
{
    use WithPagination;

    public $mostrarTodasTareas = false; 
    public $contadorTareasPendientes = 0;
    public $tareaSeleccionada = null;


    protected $listeners = ['actualizarContador'];

    public function mount()
    {
        $this->actualizarContador();
    }

    private function contarTareasPendientes()
    {
        return Tarea::where('estado', 0)
            ->where('user_id', Auth::id()) 
            ->count();
    }

    public function actualizarContador()
    {
        $this->contadorTareasPendientes = $this->contarTareasPendientes();
    }

    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        if ($tarea && $tarea->user_id == Auth::id()) {
            // Cambiar el estado solo si pertenece al usuario autenticado
            $tarea->estado = !$tarea->estado;
            $tarea->save();
            $this->contadorTareasPendientes = $this->contarTareasPendientes();
        }
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
            ? Tarea::where('user_id', Auth::id())->paginate(10) 
            : Tarea::where('user_id', Auth::id())->take(3)->get(); 

        return view('livewire.sub-component-tareas', [
            'tareas' => $tareas,
        ]);
    }

    public function verMasTarea($tareaId)
    {
        $this->tareaSeleccionada = $this->tareaSeleccionada === $tareaId ? null : $tareaId;
    }
}
