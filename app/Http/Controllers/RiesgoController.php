<?php
namespace App\Http\Controllers;

use App\Models\Riesgo;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class RiesgoController extends Controller
{
    public function indexRiesgo($proyecto_id)
    {
        $proyecto = Proyecto::findOrFail($proyecto_id);
        $riesgos = Riesgo::where('proyecto_id', $proyecto_id)->paginate(10);
        return view('riesgos.index', compact('proyecto', 'riesgos'));
    }

    public function create($proyecto_id)
    {
        $proyecto = Proyecto::findOrFail($proyecto_id);
        return view('riesgos.create', compact('proyecto'));
    }

    public function store(Request $request, $proyecto_id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'impacto' => 'required|in:positivo,negativo',
        ]);

        Riesgo::create([
            'proyecto_id' => $proyecto_id,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'impacto' => $request->impacto,
        ]);

        return redirect()->route('riesgos.index', $proyecto_id)->with('success', 'Riesgo creado exitosamente.');
    }

    public function edit($id)
    {
        $riesgo = Riesgo::findOrFail($id);
        return view('riesgos.edit', compact('riesgo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'impacto' => 'required|in:positivo,negativo',
        ]);

        $riesgo = Riesgo::findOrFail($id);
        $riesgo->update($request->all());

        return redirect()->route('riesgos.index', $riesgo->proyecto_id)->with('success', 'Riesgo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $riesgo = Riesgo::findOrFail($id);
        $riesgo->delete();

        return back()->with('success', 'Riesgo eliminado exitosamente.');
    }
}
