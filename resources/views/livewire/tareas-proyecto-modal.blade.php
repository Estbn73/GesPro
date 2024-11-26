<div>
    <h4 class="mb-3">{{ $proyecto->nombre }}</h4>
    <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
    <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
    <p><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>

    <hr>
    <div wire:loading>
        <p class="text-muted">Cargando...</p>
    </div>
    <div wire:loading.remove>
        <!-- Encabezado dinámico -->
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mt-3 mb-0">
                {{ $mostrarTodasTareas ? 'Todas las Tareas Pendientes (' . $contadorTareasPendientes . ')' : 'Tareas Pendientes (' . $contadorTareasPendientes . ')' }}
            </h5>
            <button class="btn btn-sm btn-outline-primary" wire:click="{{ $mostrarTodasTareas ? 'regresar' : 'mostrarTodas' }}">
                {{ $mostrarTodasTareas ? '← Regresar' : 'Ver más tareas' }}
            </button>
        </div>

        @if($tareas->count() > 0)
            <!-- Listado de tareas -->
            <ul class="list-group list-group-flush mt-3">
                @foreach($tareas as $tarea)
                    <li class="list-group-item d-flex align-items-start">
                        <!-- Checkbox -->
                        <input 
                            type="checkbox" 
                            wire:click="toggleEstado({{ $tarea->id }})" 
                            class="me-2 mt-2"
                            {{ $tarea->estado ? 'checked' : '' }}
                        >

                        <!-- Contenido de la tarea -->
                        <div class="flex-grow-1">
                            <strong>{{ $tarea->nombre_tarea }}</strong>
                            <p class="mb-0 text-muted" style="min-height: 40px; overflow: hidden;">
                                {{ $tareaSeleccionada === $tarea->id ? $tarea->descripcion : Str::limit($tarea->descripcion, 100, '...') }}
                            </p>
                        </div>

                        <!-- Botón "Ver más" -->
                        <button 
                            class="btn btn-sm btn-outline-primary ms-2 align-self-center"
                            style="height: 35px; align-items: center;"
                            wire:click="verMasTarea({{ $tarea->id }})">
                            {{ $tareaSeleccionada === $tarea->id ? 'Ocultar' : 'Ver más' }}
                        </button>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No hay tareas asignadas a este proyecto.</p>
        @endif

        <!-- Mostrar documentos relacionados solo si $mostrarTodasTareas es false -->
        @if(!$mostrarTodasTareas)
            <hr>
            <h5 class="mt-4">Documentos Relacionados</h5>
            @if($documentos->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($documentos as $documento)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $documento->name }}</span>
                            <a href="{{ route('documents.view', $documento->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                Ver Documento
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay documentos relacionados con este proyecto.</p>
            @endif
        @endif
    </div>
</div>