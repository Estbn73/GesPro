@extends('layouts.user')

@section('title', 'Inicio de Usuario')

@section('content')
    <h1 class="text-center mb-4">Proyectos</h1>

    <div class="row">
        @if(isset($proyectos) && count($proyectos) > 0)
            @foreach($proyectos as $proyecto)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                            <p class="card-text ">{{ $proyecto->descripcion }}</p>
                            <p><strong>Fecha Inicio:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</p>
                            <p><strong>Fecha Final:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_final)->format('d/m/Y') }}</p>
                            <p>
                                <strong>Estado:</strong> 
                                <span class="badge {{ $proyecto->estado == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalProyecto{{ $proyecto->id }}">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para cada proyecto -->
                <div class="modal fade" id="modalProyecto{{ $proyecto->id }}" tabindex="-1" aria-labelledby="modalProyectoLabel{{ $proyecto->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="modalProyectoLabel{{ $proyecto->id }}">Detalles del Proyecto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                @livewire('tareas-proyecto-modal', ['proyecto' => $proyecto])
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="text-center text-secondary fs-5 mt-5">No tienes proyectos asignados.</p>
            </div>
        @endif
    </div>
@endsection
