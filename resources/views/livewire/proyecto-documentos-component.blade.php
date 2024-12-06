<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestión de Documentos</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3" x-on:click="showModal=true">
                <i class="fas fa-plus"></i> Agregar Documento
            </button>
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Formato</th>
                        <th>Subido por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $documento)
                    <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->name }}</td>
                        <td>{{ strtoupper($documento->extension ?? 'N/A') }}</td>
                        <td>{{ $documento->user->name ?? 'Usuario desconocido' }}</td>
                        <td>
                            <button wire:click="descargarDocumento({{ $documento->id }})" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i> Descargar
                            </button>
                            <button wire:click="setItem({{ $documento->id }})" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button x-on:click="if (confirm('¿Estás seguro de eliminar este documento?')) { $wire.eliminarDocumento({{ $documento->id }}) }" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div
        x-bind:class="!showModal ? 'modal fade' : 'modal fade show'"
        x-bind:aria-hidden="!showModal ? 'true' : 'false'"
        x-bind:style="!showModal ? '' : 'display: block;'"
        x-bind:role="!showModal ? '' : 'dialog'"
        style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="guardar">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Gestionar Documento</h5>
                        <button type="button" class="btn-close" aria-label="Close" x-on:click="showModal=false" wire:click="limpiarCampos"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" class="form-control" wire:model="name" placeholder="Ingrese el nombre del documento">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Archivo</label>
                            <input type="file" id="file" class="form-control" wire:model="file" accept=".pdf,.doc,.docx,.xlsx,.csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" x-on:click="showModal=false" wire:click="limpiarCampos">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
