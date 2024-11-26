@extends('layouts.user')

@section('title', 'Miembros')

@section('content')
    <h1 class="text-center mb-4">Miembros del proyecto</h1>

    <div class="row">
        @if($proyectos->count() > 0)
            @foreach($proyectos as $proyecto)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                            <p class="card-text">{{ $proyecto->descripcion }}</p>
                            <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
                            <p><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMiembros{{ $proyecto->id }}">
                                Ver integrantes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para integrantes del proyecto -->
                <div class="modal fade" id="modalMiembros{{ $proyecto->id }}" tabindex="-1" aria-labelledby="modalMiembrosLabel{{ $proyecto->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalMiembrosLabel{{ $proyecto->id }}">Integrantes del Proyecto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                @livewire('integrantes-proyecto-modal', ['proyectoId' => $proyecto->id])
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
