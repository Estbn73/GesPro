<?php

namespace App\Http\Controllers;

use App\Models\Riesgo;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class RiesgoController extends Controller
{
    public function indexRiesgos(Proyecto $proyecto)
    {
        $riesgos = $proyecto->riesgos;
        return view('riesgos.index', compact('proyecto', 'riesgos'));
    }
        

    public function create(Proyecto $proyecto)
    {
        return view('riesgos.create', compact('proyecto'));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'impacto' => 'required|integer|min:1|max:5'
        ]);

        $proyecto->riesgos()->create($request->all());

        return redirect()->route('proyectos.riesgos.index', $proyecto)->with('success', 'Riesgo creado exitosamente');
    }

    public function edit(Riesgo $riesgo)
    {
        return view('riesgos.edit', compact('riesgo'));
    }

    public function update(Request $request, Riesgo $riesgo)
    {
        $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'impacto' => 'required|integer|min:1|max:5'
        ]);

        $riesgo->update($request->all());

        return redirect()->route('proyectos.riesgos.index', $riesgo->proyecto_id)->with('success', 'Riesgo actualizado exitosamente');
    }

    public function destroy(Riesgo $riesgo)
    {
        $riesgo->delete();
        return back()->with('success', 'Riesgo eliminado exitosamente');
    }
}
