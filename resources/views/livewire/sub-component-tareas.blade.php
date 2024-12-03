<div>
    <h5 class="d-flex justify-content-between align-items-center">
        Tareas del Usuario
        @if(!$mostrarTodasTareas)
            <button class="btn btn-primary btn-sm d-flex align-items-center" wire:click="mostrarTodas">
                <i class="bi bi-list-ul me-2"></i> Ver más tareas
            </button>
        @else
            <button class="btn btn-secondary btn-sm d-flex align-items-center" wire:click="regresar">
                <i class="bi bi-arrow-bar-up me-2"></i> Regresar
            </button>
        @endif
    </h5>
    <p>Total de tareas pendientes: {{ $contadorTareasPendientes }}</p>

    @if($tareas->count() > 0)
        <ul class="list-group">
            @foreach($tareas as $tarea)
                <li class="list-group-item d-flex flex-column align-items-start bg-white shadow-sm rounded mb-2">
                    <!-- Encabezado -->
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input me-2" 
                                id="tarea-{{ $tarea->id }}" 
                                wire:click="toggleEstado({{ $tarea->id }})"
                                {{ $tarea->estado ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold mb-0" for="tarea-{{ $tarea->id }}">
                                {{ $tarea->nombre_tarea }}
                            </label>
                        </div>
                        <button 
                            class="btn btn-outline-primary btn-sm d-flex align-items-center"
                            wire:click="verMasTarea({{ $tarea->id }})">
                            <i class="bi {{ $tareaSeleccionada === $tarea->id ? 'bi-eye-slash' : 'bi-eye' }} me-2"></i> 
                            {{ $tareaSeleccionada === $tarea->id ? 'Ocultar' : 'Ver más' }}
                        </button>
                    </div>

                    <!-- Descripción -->
                    <p class="mt-2 mb-2 text-muted">
                        {{ $tareaSeleccionada === $tarea->id ? $tarea->descripcion : Str::limit($tarea->descripcion, 100, '...') }}
                    </p>

                    <!-- Detalles Adicionales -->
                    @if($tareaSeleccionada === $tarea->id)
                        <div class="bg-light p-2 rounded">
                            <p class="mb-1"><strong><i class="bi bi-flag me-2"></i>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
                            <p class="mb-0"><strong><i class="bi bi-calendar-event me-2"></i>Fecha Final:</strong> 
                                {{ $tarea->fecha_final ? $tarea->fecha_final->format('d/m/Y') : 'Sin definir' }}
                            </p>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No tienes tareas asignadas.</p>
    @endif
</div>
