<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nota;

class SubComponentNota extends Component
{
    public $proyectoId;
    public $nuevaNota;
    public $busqueda = ''; // Filtro de búsqueda
    public $notaIdEditando = null; 
    public $mostrarFormulario = false; 
    public $mostrarTodas = false; 
    public $notas = []; 

    public function mount($proyectoId)
    {
        $this->proyectoId = $proyectoId;
        $this->actualizarNotas();
    }

    public function agregarNota()
    {
        $this->validate([
            'nuevaNota' => 'required|string|max:255',
        ]);

        Nota::create([
            'contenido' => $this->nuevaNota,
            'proyecto_id' => $this->proyectoId,
            'user_id' => auth()->id(),
        ]);

        $this->nuevaNota = '';
        $this->mostrarFormulario = false;

        $this->actualizarNotas();
    }

    public function editarNota($id)
    {
        $nota = Nota::find($id);

        if (!$nota || $nota->user_id !== auth()->id()) {
            session()->flash('mensajeError', 'No tienes permiso para editar esta nota.');
            return;
        }

        $this->notaIdEditando = $id;
        $this->nuevaNota = $nota->contenido; // Cargamos el contenido actual de la nota en el formulario
        $this->mostrarFormulario = true;
    }

    public function guardarEdicion()
    {
        $this->validate([
            'nuevaNota' => 'required|string|max:255',
        ]);

        $nota = Nota::find($this->notaIdEditando);

        if ($nota && $nota->user_id === auth()->id()) {
            $nota->update(['contenido' => $this->nuevaNota]);

            session()->flash('mensajeExito', 'La nota fue actualizada correctamente.');
        } else {
            session()->flash('mensajeError', 'No tienes permiso para editar esta nota.');
        }

        $this->nuevaNota = '';
        $this->notaIdEditando = null;
        $this->mostrarFormulario = false;

        $this->actualizarNotas();
    }

    public function toggleMostrarTodas()
    {
        $this->mostrarTodas = !$this->mostrarTodas;
        $this->actualizarNotas();
    }

    public function actualizarNotas()
    {
        $query = Nota::where('proyecto_id', $this->proyectoId);
    
        if (!empty($this->busqueda)) {
            $query->where(function ($query) {
                $query->where('contenido', 'like', '%' . $this->busqueda . '%')
                      ->orWhereHas('user', function ($q) {
                          $q->where('name', 'like', '%' . $this->busqueda . '%');
                      })
                      ->orWhereDate('created_at', $this->busqueda);
            });
        }
    
        // Determina cuántas notas mostrar en función de mostrarTodas
        $this->notas = $this->mostrarTodas ? $query->get() : $query->take(5)->get();
    }
    

    public function eliminarNota($id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            session()->flash('mensajeError', 'La nota no existe.');
            return;
        }

        if ($nota->user_id !== auth()->id()) {
            session()->flash('mensajeError', 'No tienes permiso para eliminar esta nota.');
            return;
        }

        $nota->delete();
        session()->flash('mensajeExito', 'La nota fue eliminada correctamente.');

        $this->actualizarNotas();
    }
    public function updatedBusqueda()
    {
        $this->actualizarNotas();
    }


    public function render()
    {
        return view('livewire.sub-component-nota', [
            'notas' => $this->notas,
        ]);
    }
}
