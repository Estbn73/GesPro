<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function create(Proyecto $proyecto)
    {
        return view('presupuestos.create', compact('proyecto'));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string'
        ]);

        $proyecto->presupuesto()->create($request->all());

        return redirect()->route('proyectos.show', $proyecto)->with('success', 'Presupuesto creado exitosamente');
    }

    public function edit(Presupuesto $presupuesto)
    {
        return view('presupuestos.edit', compact('presupuesto'));
    }

    public function update(Request $request, Presupuesto $presupuesto)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string'
        ]);

        $presupuesto->update($request->all());

        return redirect()->route('proyectos.show', $presupuesto->proyecto_id)->with('success', 'Presupuesto actualizado exitosamente');
    }

    public function destroy(Presupuesto $presupuesto)
    {
        $presupuesto->delete();
        return back()->with('success', 'Presupuesto eliminado exitosamente');
    }
}
