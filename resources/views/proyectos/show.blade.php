@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pt-4">{{ $proyecto->nombre }}</h1>
    <p>{{ $proyecto->descripcion }}</p>
    <p><strong>Fecha de inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p><strong>Fecha de finalización:</strong> {{ $proyecto->fecha_final }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>

    <!-- Botones para Riesgos y Tareas -->
    <div class="row">
        @foreach(['riesgos' => 'Riesgos', 'tareas' => 'Tareas'] as $key => $title)
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ ucfirst($key) }}">
                            Ver opciones
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modales para Riesgos y Tareas -->
@foreach(['riesgos' => 'Riesgos', 'tareas' => 'Tareas'] as $key => $title)
    <div class="modal fade" id="modal{{ ucfirst($key) }}" tabindex="-1" aria-labelledby="modal{{ ucfirst($key) }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal{{ ucfirst($key) }}Label">Gestión de {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Componentes de Livewire -->
                    @if($key === 'riesgos')
                        @livewire('proyecto-riesgo-component', ['proyecto' => $proyecto->id])
                    @elseif($key === 'tareas')
                        @livewire('proyecto-tareas-component', ['id' => $proyecto->id])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
@livewireScripts
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
