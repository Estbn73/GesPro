<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class UserController extends Controller
{
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
}