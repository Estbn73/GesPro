<div x-data="{showModal: $wire.entangle('showModal')}">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" x-on:click="showModal=true">
                Agregar
            </button>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Tarea</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->id }}</td>
                            <td>{{ $tarea->nombre_tarea }}</td>
                            <td>{{ $tarea->descripcion }}</td>
                            <td>
                                <button wire:click ="setItem({{$tarea->id}})">Editar</button>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div
        x-bind:class="! showModal ? 'modal fade' : 'modal fade show'"
        x-bind:aria-hidden="! showModal ? 'true' : 'false'"
        x-bind:style="! showModal ? '' : 'display: block;'"
        x-bind:role="!showModal ? '' : 'dialog'"
    >
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form wire:submit="guardar()">
                    <div class="modal-header">
                        <h5>Tarea</h5>
                        <button type="button" class="close" data.dismiss="modal" arial-label="Close" x-on:click="showModal= false">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" wire:model="nombre_tarea">
                        <input type="text" class="form-control" wire:model="descripcion">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" x-on:click="showModal=false">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
