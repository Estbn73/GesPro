<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Tarea;

class UserController extends Controller
{

    public function calendario()
    {
        $tareas = Tarea::where('user_id', auth()->id())->get(['nombre_tarea', 'fecha_final', 'prioridad']);
        $proyectos = Proyecto::all(['nombre', 'fecha_final']);
    
        $eventos = [];
    
        foreach ($tareas as $tarea) {
            $eventos[] = [
                'title' => 'Tarea: ' . $tarea->nombre_tarea . ' (' . ucfirst($tarea->prioridad) . ')',
                'start' => $tarea->fecha_final,
                'color' => $tarea->prioridad === 'alta' ? 'red' : ($tarea->prioridad === 'media' ? 'orange' : 'green'),
            ];
        }
    
        foreach ($proyectos as $proyecto) {
            $eventos[] = [
                'title' => 'Proyecto: ' . $proyecto->nombre,
                'start' => $proyecto->fecha_final,
                'color' => 'blue',
            ];
        }
    
        return view('user.calendario', compact('eventos'));
    }
    

    public function index()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        $proyectos = $user->proyectos; // Obtener los proyectos asignados al usuario

        return view('user/home', compact('user', 'proyectos')); 
    }

    public function asignarUsuario(Request $request, $proyectoId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', 
        ]);

        $userId = $request->input('user_id'); 

        $proyecto = Proyecto::findOrFail($proyectoId);
        $proyecto->equipo()->attach($userId, ['lider' => false]); 

        return redirect()->back()->with('success', 'Usuario asignado al proyecto.');
    }
    public function miembros()
    {
        $proyectos = Proyecto::whereHas('equipo', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('user.miembros', compact('proyectos'));
    }
    

}