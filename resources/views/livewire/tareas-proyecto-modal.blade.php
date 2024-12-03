<div>
    <!-- Menú horizontal con Tabs scrollable -->
    <div class="nav nav-tabs-wrapper" style="overflow-x: auto; white-space: nowrap; -webkit-overflow-scrolling: touch;">
        <ul class="nav nav-tabs" id="projectTabs" role="tablist" style="display: inline-flex;">
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
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    id="presupuesto-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#presupuesto" 
                    type="button" 
                    role="tab" 
                    aria-controls="presupuesto" 
                    aria-selected="false">
                    <i class="fas fa-dollar-sign me-2"></i> Presupuesto
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    id="notas-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#notas" 
                    type="button" 
                    role="tab" 
                    aria-controls="notas" 
                    aria-selected="false">
                    <i class="fas fa-sticky-note me-2"></i> Notas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    id="riesgo-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#riesgo" 
                    type="button" 
                    role="tab" 
                    aria-controls="riesgo" 
                    aria-selected="false">
                    <i class="fas fa-exclamation-triangle me-2"></i> Riesgos
                </button>
            </li>
        </ul>
    </div>

    <!-- Contenido de las Tabs -->
    <div class="tab-content mt-3">
        <!-- Información General -->
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
             @livewire('sub-component-informacion', ['proyecto' => $proyecto])
        </div>

        <!-- Tareas -->
        <div class="tab-pane fade" id="tareas" role="tabpanel" aria-labelledby="tareas-tab">
            @livewire('sub-component-tareas', ['proyectoId' => $proyecto->id])
        </div>

        <!-- Documentos -->
        <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">
            @livewire('sub-component-documentos', ['proyectoId' => $proyecto->id])
        </div>

        <!-- Presupuesto -->
        <div class="tab-pane fade" id="presupuesto" role="tabpanel" aria-labelledby="presupuesto-tab">
            @livewire('sub-component-presupuesto', ['proyectoId' => $proyecto->id])
        </div>

        <!-- Notas -->
        <div class="tab-pane fade" id="notas" role="tabpanel" aria-labelledby="notas-tab">
            @livewire('sub-component-nota', ['proyectoId' => $proyecto->id])
        </div>

        <!-- Riesgos -->
        <div class="tab-pane fade" id="riesgo" role="tabpanel" aria-labelledby="riesgo-tab">
            @livewire('sub-component-riesgo', ['proyectoId' => $proyecto->id])
        </div>
    </div>
</div>
