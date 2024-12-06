<div>
    <h5 class="mb-3">Documentos Relacionados</h5>

    <!-- Mensajes de éxito -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Subir Documento -->
    <form wire:submit.prevent="subirDocumento" class="mb-4">
        <div class="mb-3">
            <label for="nombreDocumento" class="form-label">Nombre del Documento</label>
            <input type="text" id="nombreDocumento" wire:model="nombreDocumento" class="form-control">
            @error('nombreDocumento') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="archivo" class="form-label">Archivo</label>
            <input type="file" id="archivo" wire:model="archivo" class="form-control">
            @error('archivo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Subir Documento</button>
    </form>

    <!-- Listado de Documentos -->
    @if($documentos->count() > 0)
        <ul class="list-group">
            @foreach($documentos as $documento)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $documento->name }}</span>
                    <div>
                        <button wire:click="descargarDocumento({{ $documento->id }})" class="btn btn-sm btn-secondary">
                            Descargar
                        </button>
                        <button wire:click="eliminarDocumento({{ $documento->id }})" class="btn btn-sm btn-danger">
                            Eliminar
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No hay documentos relacionados con este proyecto.</p>
    @endif
</div>
