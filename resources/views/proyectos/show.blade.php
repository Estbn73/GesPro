@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $proyecto->nombre }}</h1>
    <p>{{ $proyecto->descripcion }}</p>
    <p><strong>Fecha de inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p><strong>Fecha de finalización:</strong> {{ $proyecto->fecha_final }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado }}</p>

    <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tareas</h5>
                        <a href="{{route('proyecto.tareas', ['proyecto'=>$proyecto->id])}}" class="btn btn-primary"></a>
                    </div>
                </div>
            </div>
    </div>

    <div class="row">
        @foreach(['riesgos' => 'Riesgos', 'presupuestos' => 'Presupuesto', 'notas' => 'Notas', 'tareas' => 'Tareas', 'documentos' => 'Documentos', 'usuarios' => 'Usuarios Asignados'] as $key => $title)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ ucfirst($key) }}">Ver opciones</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modales para cada sección con integración de Livewire -->
@foreach(['riesgos' => 'Riesgos', 'presupuestos' => 'Presupuesto', 'notas' => 'Notas', 'tareas' => 'Tareas', 'documentos' => 'Documentos', 'usuarios' => 'Usuarios Asignados'] as $key => $title)
    <div class="modal fade" id="modal{{ ucfirst($key) }}" tabindex="-1" aria-labelledby="modal{{ ucfirst($key) }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal{{ ucfirst($key) }}Label">Gestión de {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Componente de Livewire para la sección correspondiente -->
                    @if($key === 'riesgos')
                            @livewire('App\Http\Livewire\ProyectoRiesgoComponent', ['proyecto' => $proyecto])
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
