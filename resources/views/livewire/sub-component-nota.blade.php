<div>
    <h5 class="text fw-bold mb-3">Gestión de Notas</h5>

    <!-- Mostrar mensajes -->
    @if (session()->has('mensajeExito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensajeExito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('mensajeError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('mensajeError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botones de Agregar Nota y Ver Más Notas -->
    <div class="d-flex flex-wrap gap-3 mb-4">
        <button class="btn btn-primary" wire:click="$set('mostrarFormulario', true)">
            <i class="bi bi-plus-circle me-2"></i> 
            {{ $notaIdEditando ? 'Editar Nota' : 'Agregar Nota' }}
        </button>
        <button class="btn btn-outline-primary" wire:click="toggleMostrarTodas">
            <i class="bi bi-eye me-2"></i>
            {{ $mostrarTodas ? 'Mostrar Menos' : 'Ver Más Notas' }}
        </button>
    </div>

    <!-- Cuadro de Búsqueda (Visible solo si se muestran todas las notas) -->
    @if ($mostrarTodas)
        <div class="mb-3">
            <!-- Cuadro de búsqueda -->
            <input 
                type="text" 
                class="form-control shadow-sm" 
                wire:model.debounce.500ms="busqueda" 
                placeholder="Filtrar por contenido, autor o fecha (YYYY-MM-DD)">

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
                                    <button class="btn btn-warning btn-sm d-flex align-items-center" wire:click="editarNota({{ $nota->id }})" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm d-flex align-items-center" onclick="confirmarEliminar({{ $nota->id }})" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
