<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    // Listar notas de un proyecto
    public function indexNotas(Proyecto $proyecto)
    {
        $items = $proyecto->notas; // Obtener las notas del proyecto
        $section = 'notas'; // Nombre de la sección actual
    
        return view('notas.index', compact('items', 'section', 'proyecto'));
    }

    // Mostrar formulario de creación de una nueva nota
    public function create(Proyecto $proyecto)
    {
        return view('notas.create', compact('proyecto'));
    }

    // Guardar una nueva nota
    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
        ]);

        $proyecto->notas()->create($request->all());
        return redirect()->route('proyectos.notas.index', $proyecto->id);
    }

    // Mostrar formulario de edición de una nota
    public function edit(Nota $nota)
    {
        return view('notas.edit', compact('nota'));
    }

    // Actualizar nota
    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
        ]);

        $nota->update($request->all());
        return redirect()->route('proyectos.notas.index', $nota->proyecto_id);
    }

    // Eliminar nota
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return back();
    }

    // Cargar vista de sección para el contenido dinámico en el modal
    public function showSectionView($proyectoId, $section, $view)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);

        switch ($section) {
            case 'notas':
                $items = $proyecto->notas;
                return view("notas.{$view}", compact('proyecto', 'items'));
            // Puedes agregar más casos aquí para otras secciones como riesgos, presupuestos, etc.
            default:
                abort(404); // Manejo de errores si la sección no existe
        }
    }   
}
