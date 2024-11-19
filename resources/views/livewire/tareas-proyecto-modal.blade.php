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
        @if(!$mostrarTodasTareas)
            <!-- Vista inicial con solo 3 tareas -->
            <h5 class="mt-3">Tareas Pendientes ({{ $contadorTareasPendientes }})</h5>
            @if($tareas->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($tareas as $tarea)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $tarea->nombre_tarea }}</strong>: {{ $tarea->descripcion }}
                            </div>
                            <div>
                                <input 
                                    type="checkbox" 
                                    wire:click="toggleEstado({{ $tarea->id }})" 
                                    {{ $tarea->estado ? 'checked' : '' }}
                                >
                                <span class="badge bg-{{ $tarea->estado ? 'success' : 'secondary' }}">
                                    {{ $tarea->estado ? 'Completada' : 'Pendiente' }}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-primary" wire:click="mostrarTodas">Ver más tareas</button>
                </div>
            @else
                <p class="text-muted">No hay tareas asignadas a este proyecto.</p>
            @endif

            <!-- Documentos Relacionados -->
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
        @else
            <!-- Vista con todas las tareas -->
            <button class="btn btn-sm btn-outline-secondary mb-3" wire:click="regresar">← Regresar</button>
            <h5 class="mt-3">Todas las Tareas Pendientes</h5>
            @if($tareas->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($tareas as $tarea)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $tarea->nombre_tarea }}</strong>: {{ $tarea->descripcion }}
                            </div>
                            <div>
                                <input 
                                    type="checkbox" 
                                    wire:click="toggleEstado({{ $tarea->id }})" 
                                    {{ $tarea->estado ? 'checked' : '' }}
                                >
                                <span class="badge bg-{{ $tarea->estado ? 'success' : 'secondary' }}">
                                    {{ $tarea->estado ? 'Completada' : 'Pendiente' }}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay tareas asignadas a este proyecto.</p>
            @endif
        @endif
    </div>
</div>
