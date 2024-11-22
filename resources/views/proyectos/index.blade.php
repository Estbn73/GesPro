@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Proyectos</h1>

    <div class="d-flex justify-content-end mb-4 gap-2">
        @livewire('crear-proyecto-modal')
        @livewire('eliminar-proyectos-modal')
    </div>

    <div class="row">
        @foreach($proyectos as $proyecto)
        <div class="col-md-4 mb-4">
            <!-- Agregar clase condicional para el color de fondo -->
            <div class="card shadow-sm {{ $proyecto->estado == 1 ? 'border-success' : '' }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                    <p class="card-text">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                    <p class="card-text"><strong>Estado:</strong>
                        <span
                            class="badge"
                            style="background-color: {{ $proyecto->estado == 1 ? '#28a745' : '#6c757d' }}; color: #fff;">
                            {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                        </span>
                    </p>
                    <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-primary btn-sm">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection