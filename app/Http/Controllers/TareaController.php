<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Mostrar una lista de las tareas.
     */
    public function index()
    {
        // Obtener todas las tareas con su proyecto relacionado y paginarlas
        $tareas = Tarea::with('proyecto')->paginate(10);
        
        return view('tareas.index', compact('tareas'));
    }
    

    /**
     * Mostrar el formulario para crear una nueva tarea.
     */
    public function create()
    {
        // Obtener todos los proyectos para el menú desplegable
        $proyectos = Proyecto::all();
        return view('tareas.create', compact('proyectos'));
    }

    /**
     * Almacenar una nueva tarea en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_tarea' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        // Crear la tarea
        Tarea::create($request->all());

        // Redirigir con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Mostrar el formulario para editar una tarea existente.
     */
    public function edit(Tarea $tarea)
    {
        // Obtener todos los proyectos para el menú desplegable
        $proyectos = Proyecto::all();
        return view('tareas.edit', compact('tarea', 'proyectos'));
    }

    /**
     * Actualizar una tarea existente en la base de datos.
     */
    public function update(Request $request, Tarea $tarea)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_tarea' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        // Actualizar la tarea
        $tarea->update($request->all());

        // Redirigir con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Eliminar una tarea de la base de datos.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
    
        // Redirigir a la página anterior o a una ruta válida
        return redirect()->route('proyecto.tareas', $tarea->proyecto_id)
                         ->with('success', 'Tarea eliminada exitosamente.');
    }
    
    
}
