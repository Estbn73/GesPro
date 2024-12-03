<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;


class CalendarioController extends Controller
{

    public function obtenerEventos()
    {
        $tareas = Tarea::where('user_id', Auth::id())->get();
    
        $eventos = $tareas->map(function ($tarea) {
            $clasePrioridad = match ($tarea->prioridad) {
                'alta' => 'evento-alta',
                'media' => 'evento-media',
                default => 'evento-baja',
            };
    
            return [
                'title' => $tarea->nombre_tarea ?? 'Sin título',
                'start' => $tarea->fecha_inicio, 
                'end' => $tarea->fecha_final,   
                'className' => $clasePrioridad,
            ];
        });
    
        return response()->json($eventos);
    }
    
    
}
