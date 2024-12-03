@extends('layouts.user')

@section('title', 'Inicio de Usuario')

@section('content')
    <h1 class="text-center mb-4">Proyectos</h1>

    <div class="row">
        @if(isset($proyectos) && count($proyectos) > 0)
            @foreach($proyectos as $proyecto)
                <!-- Tarjeta del Proyecto -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light text-center border-0">
                            <h5 class="mb-0 fw-bold text">{{ $proyecto->nombre }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">{{ $proyecto->descripcion }}</p>
                            <p>
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}
                            </p>
                            <p>
                                <i class="fas fa-calendar-check text-success me-2"></i>
                                <strong>Final:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_final)->format('d/m/Y') }}
                            </p>
                            <p>
                                <strong>Estado:</strong> 
                                <span class="badge {{ $proyecto->estado == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </p>
                            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalProyecto{{ $proyecto->id }}">
                                <i class="fas fa-info-circle me-2"></i> Ver más
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para cada proyecto -->
                <div class="modal fade" id="modalProyecto{{ $proyecto->id }}" tabindex="-1" aria-labelledby="modalProyectoLabel{{ $proyecto->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <!-- Encabezado del Modal -->
                            <div class="modal-header bg text-white">
                                <h5 class="modal-title" id="modalProyectoLabel{{ $proyecto->id }}">
                                    <i class="fas fa-folder-open me-2"></i> Detalles del Proyecto: {{ $proyecto->nombre }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <!-- Cuerpo del Modal -->
                            <div class="modal-body">
                                @livewire('tareas-proyecto-modal', ['proyecto' => $proyecto])
                            </div>
                            <!-- Pie de página del Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
