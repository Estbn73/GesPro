<div>
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
                            class="btn btn-outline-primary btn-sm"
                            wire:click="verMasTarea({{ $tarea->id }})">
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
                            <p class="mb-1"><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
                            <p class="mb-0"><strong>Fecha Final:</strong> {{ $tarea->fecha_final ? $tarea->fecha_final->format('d/m/Y') : 'Sin definir' }}</p>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No hay tareas asignadas a este proyecto.</p>
    @endif
</div>
    