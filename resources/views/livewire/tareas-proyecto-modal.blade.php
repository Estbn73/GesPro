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
            @livewire('tareas-component', ['proyectoId' => $proyecto->id])
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


