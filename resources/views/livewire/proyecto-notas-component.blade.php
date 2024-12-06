<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestión de Notas</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success mb-3 " x-on:click="showModal=true">
                <i class="fas fa-plus"></i> Agregar Nota
            </button>
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Contenido</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notas as $nota)
                    <tr>
                        <td>{{ $nota->id }}</td>
                        <td>{{ $nota->contenido }}</td>
                        <td>{{ $nota->user->name ?? 'Usuario no encontrado' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="setItem({{ $nota->id }})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button x-on:click="if (confirm('¿Estás seguro de eliminar esta nota?')) { $wire.eliminarNota({{ $nota->id }}) }" class="btn btn-sm btn-danger">
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
                        <h5 class="modal-title">Gestionar Nota</h5>
                        <button type="button" class="btn-close" aria-label="Close" x-on:click="showModal=false" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido de la Nota</label>
                            <textarea id="contenido" class="form-control" wire:model="contenido" rows="5" placeholder="Ingrese el contenido de la nota"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" x-on:click="showModal=false" wire:click="cerrarModal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>