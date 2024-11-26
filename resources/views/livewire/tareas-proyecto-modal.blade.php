<div>
    <!-- Menú horizontal con Tabs -->
    <ul class="nav nav-tabs" id="projectTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link active" 
                id="info-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#info" 
                type="button" 
                role="tab" 
                aria-controls="info" 
                aria-selected="true">
                <i class="fas fa-info-circle me-2"></i> Información General
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link" 
                id="tareas-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#tareas" 
                type="button" 
                role="tab" 
                aria-controls="tareas" 
                aria-selected="false">
                <i class="fas fa-tasks me-2"></i> Tareas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link" 
                id="documentos-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#documentos" 
                type="button" 
                role="tab" 
                aria-controls="documentos" 
                aria-selected="false">
                <i class="fas fa-folder me-2"></i> Documentos
            </button>
        </li>
    </ul>

    <!-- Contenido de las Tabs -->
    <div class="tab-content mt-3">
        <!-- Información General -->
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
            <p><strong>Fecha Final:</strong> {{ $proyecto->fecha_final }}</p>
        </div>

        <!-- Tareas -->
        <div class="tab-pane fade" id="tareas" role="tabpanel" aria-labelledby="tareas-tab">
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
                                    <p class="mb-0"><strong>Fecha de Entrega:</strong> {{ $tarea->fecha_entrega }}</p>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay tareas asignadas a este proyecto.</p>
            @endif
        </div>

        <!-- Documentos -->
        <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">
            <h5 class="mb-3">Documentos Relacionados</h5>
            @if($documentos->count() > 0)
                <ul class="list-group">
                    @foreach($documentos as $documento)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $documento->name }}</span>
                            <a href="{{ route('documents.view', $documento->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                Ver Documento
                            </a>
                            <a href="{{ route('documents.download', $documento->id) }}" class="btn btn-sm btn-secondary">
                                Descargar
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay documentos relacionados con este proyecto.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let activeTab = '#info'; // Tab predeterminado

        // Restaurar el tab activo después de una actualización de Livewire
        Livewire.hook('message.processed', () => {
            const tabElement = document.querySelector(`button[data-bs-target="${activeTab}"]`);
            if (tabElement) {
                new bootstrap.Tab(tabElement).show();
            }
        });

        // Guardar el tab activo al cambiar de tab
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', (event) => {
                activeTab = event.target.dataset.bsTarget;
            });
        });
    });
</script>
