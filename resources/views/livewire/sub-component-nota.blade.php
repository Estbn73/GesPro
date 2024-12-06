<div>
    <h5 class="text fw-bold mb-3">Gestión de Notas</h5>

    <!-- Mostrar mensajes -->
    @if (session()->has('mensajeExito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensajeExito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botones de acciones -->
    <div class="d-flex flex-wrap gap-3 mb-4">
        <!-- Botón para abrir el formulario -->
        <button class="btn btn-primary" wire:click="$set('mostrarFormulario', true)">
            <i class="bi bi-plus-circle me-2"></i> Agregar Nota
        </button>

        <!-- Botón para alternar entre mostrar todas o limitar -->
        <button class="btn btn-outline-primary" wire:click="toggleMostrarTodas">
            <i class="bi bi-eye me-2"></i> 
            {{ $mostrarTodas ? 'Mostrar Menos' : 'Ver Más Notas' }}
        </button>
    </div>

    <!-- Cuadro de búsqueda -->
    @if ($mostrarTodas)
        <div class="mb-3 position-relative">
        <input 
            type="text" 
            class="form-control shadow-sm" 
            wire:model.lazy="busqueda" 
            placeholder="Buscar por contenido, autor o fecha (YYYY-MM-DD)">

            <div wire:loading wire:target="busqueda" class="spinner-border text-primary position-absolute top-50 end-0 translate-middle-y" role="status" style="width: 1rem; height: 1rem;">
                <span class="visually-hidden">Buscando...</span>
            </div>
        </div>
    @endif

    <!-- Formulario de Agregar Nota -->
    @if ($mostrarFormulario)
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="mb-3">Nueva Nota</h6>
                <div class="mb-3">
                    <textarea 
                        wire:model="nuevaNota" 
                        class="form-control mb-2" 
                        placeholder="Escribe el contenido de la nota aquí..." 
                        rows="3"></textarea>
                    @error('nuevaNota') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" wire:click="agregarNota">Guardar</button>
                        <button class="btn btn-secondary" wire:click="$set('mostrarFormulario', false)">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Notas -->
    @if ($notas->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Autor</th>
                        <th>Nota</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr>
                            <td class="text-center">
                                <strong>{{ $nota->user->name ?? 'Usuario desconocido' }}</strong>
                            </td>
                            <td>{{ $nota->contenido }}</td>
                            <td class="text-center">
                                <small>{{ $nota->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($nota->user_id === auth()->id())
                                        <button 
                                            class="btn btn-warning btn-sm d-flex align-items-center" 
                                            wire:click="editarNota({{ $nota->id }})" 
                                            title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button 
                                            class="btn btn-danger btn-sm d-flex align-items-center" 
                                            onclick="confirmarEliminar({{ $nota->id }})" 
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @else
                                        <span class="text-muted">Sin permisos</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted text-center mt-3">No hay notas disponibles para este proyecto.</p>
    @endif
</div>

<script>
    function confirmarEliminar(notaId) {
        if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
            @this.call('eliminarNota', notaId);
        }
    }
</script>
