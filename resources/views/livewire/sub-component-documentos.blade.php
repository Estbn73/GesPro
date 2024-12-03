<div>
    <h5 class="mb-3">Gestión de Documentos</h5>

    <!-- Mostrar mensaje de éxito -->
    @if($mensajeExito)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $mensajeExito }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botón para abrir el formulario de subir documentos -->
    <button class="btn btn-primary mb-4" wire:click="$set('mostrarFormulario', true)">
        <i class="bi bi-upload me-2"></i> Subir Documento
    </button>

    <!-- Formulario de Subir Documento  -->
    @if($mostrarFormulario)
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="mb-3">Nuevo Documento</h6>
                <form wire:submit.prevent="subirDocumento">
                    <div class="mb-3">
                        <label for="nombreDocumento" class="form-label">Nombre del Documento</label>
                        <input type="text" id="nombreDocumento" wire:model="nombreDocumento" class="form-control" placeholder="Ej. Contrato">
                        @error('nombreDocumento') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Seleccionar Archivo</label>
                        <input type="file" id="archivo" wire:model="archivo" class="form-control">
                        @error('archivo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Subir</button>
                        <button type="button" class="btn btn-secondary" wire:click="$set('mostrarFormulario', false)">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Lista de Documentos -->
    @if($documentos->isNotEmpty())
        <ul class="list-group">
            @foreach($documentos as $documento)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $documento->name }}</strong>
                        <br>
                        <small>Subido por: {{ $documento->user->name ?? 'Usuario desconocido' }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ Storage::url($documento->file_path) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                        <a href="#" wire:click.prevent="descargarDocumento({{ $documento->id }})" class="btn btn-sm btn-secondary">
                            <i class="bi bi-download me-1"></i> Descargar
                        </a>
                        <!-- Mostrar botón de eliminar solo si el usuario es el propietario -->
                        @if($documento->user_id === auth()->id())
                            <button
                                class="btn btn-sm btn-danger"
                                onclick="confirmDelete({{ $documento->id }})">
                                <i class="bi bi-trash me-1"></i> Eliminar
                            </button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No hay documentos asociados a este proyecto.</p>
    @endif
</div>

<script>
    function confirmDelete(documentId) {
        if (confirm('¿Estás seguro de que deseas eliminar este documento?')) {
            @this.call('eliminarDocumento', documentId); 
        }
    }
</script>
