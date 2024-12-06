@extends('layouts.user')

@section('title', 'Miembros')

@section('content')
    <h1 class="text-center mb-4">Miembros del Proyecto</h1>

    <div class="row">
        @if($proyectos->count() > 0)
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
                                <strong>Inicio:</strong> {{ $proyecto->fecha_inicio }}
                            </p>
                            <p>
                                <i class="fas fa-calendar-check text-success me-2"></i>
                                <strong>Final:</strong> {{ $proyecto->fecha_final }}
                            </p>
                            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalMiembros{{ $proyecto->id }}">
                                <i class="fas fa-users me-2"></i> Ver Integrantes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para integrantes del proyecto -->
                <div class="modal fade" id="modalMiembros{{ $proyecto->id }}" tabindex="-1" aria-labelledby="modalMiembrosLabel{{ $proyecto->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <!-- Encabezado del Modal -->
                            <div class="modal-header bg text-white">
                                <h5 class="modal-title" id="modalMiembrosLabel{{ $proyecto->id }}">
                                    <i class="fas fa-users me-2"></i> Integrantes del Proyecto: {{ $proyecto->nombre }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <!-- Cuerpo del Modal -->
                            <div class="modal-body">
                                @livewire('integrantes-proyecto-modal', ['proyectoId' => $proyecto->id])
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
            <p class="text-center text-muted fs-5 mt-5">No tienes proyectos asignados.</p>
        @endif
    </div>
@endsection
