<?php

namespace App\Http\Livewire;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProyectoEquiposComponent extends Component
{
    public $proyecto = null;
    public $equipo = null;
    public $showModal = false;
    public $user_id = null;
    public $lider = 0;
    public $miembro_id = null;

    public function mount($id)
    {
        // Cargar el proyecto y su equipo
        $this->proyecto = Proyecto::findOrFail($id);
        $this->equipo = $this->proyecto->equipo; // Obtén todos los miembros asociados
    }

    public function render()
    {
        // Obtener todos los usuarios disponibles para asignar al proyecto
        $usuarios = User::all();

        return view('livewire.proyecto-equipos-component', [
            'equipo' => $this->equipo,
            'usuarios' => $usuarios,
        ]);
    }

    public function guardar()
    {
        if ($this->miembro_id != null) {
            // Actualizar un miembro existente
            $this->proyecto->equipo()->updateExistingPivot($this->miembro_id, [
                'lider' => $this->lider,
            ]);
        } else {
            // Agregar un nuevo miembro al proyecto
            $this->proyecto->equipo()->attach($this->user_id, [
                'lider' => $this->lider,
            ]);
        }

        // Actualizar la lista de miembros del equipo
        $this->equipo = $this->proyecto->equipo;

        $this->limpiarCampos();
        $this->showModal = false;
    }

    public function limpiarCampos()
    {
        $this->reset('user_id', 'lider', 'miembro_id');
    }

    public function setItem($id)
    {
        // Establecer los datos de un miembro para editar
        $miembro = $this->proyecto->equipo()->where('user_id', $id)->first();
        if ($miembro) {
            $this->user_id = $miembro->id;
            $this->lider = $miembro->pivot->lider;
            $this->miembro_id = $id;
            $this->showModal = true;
        }
    }

    public function cerrarModal()
    {
        $this->limpiarCampos(); // Limpia los campos
        $this->showModal = false; // Cierra el modal
    }

    public function eliminarMiembro($id)
    {
        // Eliminar un miembro del proyecto
        $this->proyecto->equipo()->detach($id);

        // Actualizar la lista de miembros del equipo
        $this->equipo = $this->proyecto->equipo;
        session()->flash('success', 'Miembro eliminado exitosamente.');
    }
}
