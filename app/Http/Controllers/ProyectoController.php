<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with(['tareas', 'documentos'])->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('crud_proyectos.create');
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
        return view('crud_proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'estado' => 'boolean',
        ]);

        $proyecto->update($request->all());
        
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load(['tareas', 'documentos', 'riesgos', 'presupuesto', 'notas', 'equipo']);
    
        return view('proyectos.show', compact('proyecto'));
    }
    
    public function proyectoTareas(Proyecto $proyecto)
    {
        $tareas = $proyecto->tareas;
        $documentos = $proyecto->documentos;

        return view('proyectos.tareas', compact('proyecto', 'tareas', 'documentos'));
    }
}
