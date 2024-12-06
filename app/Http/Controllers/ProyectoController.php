<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with(['tareas', 'documents'])->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'estado' => 'boolean',
        ]);

        Proyecto::create($request->only(['nombre', 'descripcion', 'fecha_inicio', 'fecha_final', 'estado']));
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'estado' => 'required|boolean',
        ]);

        // Actualizar el proyecto en la base de datos
        $proyecto->update($validated);

        // Redirigir a la lista de proyectos con un mensaje de éxito
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }


    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load(['tareas', 'documents', 'riesgos', 'presupuestos', 'notas', 'equipo']);

        return view('proyectos.show', compact('proyecto'));
    }

    public function proyectoTareas($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view(
            'proyectos.tareas',
            [
                'id' => $id,
                'proyectoId' => $proyecto->id,
                'proyectoNombre' => $proyecto->nombre,
            ]
        );
    }

    public function proyectoRiesgos($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.riesgos', [
            'id' => $id,
            'proyectoId' => $proyecto->id,
            'proyectoNombre' => $proyecto->nombre,
        ]);
    }

    public function proyectoPresupuestos($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('proyectos.presupuestos2', [
            'id' => $id,
            'proyectoId' => $proyecto->id,
            'proyectoNombre' => $proyecto->nombre,
        ]);
    }

    public function proyectoNotas($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // dd($proyecto);

        return view('proyectos.notas', [
            'id' => $id,
            'proyectoId' => $proyecto->id,
            'proyectoNombre' => $proyecto->nombre,
        ]);
    }

    public function proyectoDocumentos($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // dd($proyecto);

        return view('proyectos.documentos', [
            'id' => $id,
            'proyectoId' => $proyecto->id,
            'proyectoNombre' => $proyecto->nombre,
        ]);
    }

    public function proyectoEquipos($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // dd($proyecto);

        return view('proyectos.equipos', [
            'id' => $id,
            'proyectoId' => $proyecto->id,
            'proyectoNombre' => $proyecto->nombre,
        ]);
    }


}
