<div>
    <!-- Botón para abrir el modal -->
    <button class="btn btn-danger" wire:click="abrirModalEliminar">Eliminar Proyectos</button>

    <!-- Modal -->
    @if ($showModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Proyectos</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tabla de proyectos -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proyectos as $proyecto)
                                    <tr>
                                        <td>{{ $proyecto->id }}</td>
                                        <td>{{ $proyecto->nombre }}</td>
                                        <td>{{ Str::limit($proyecto->descripcion, 50) }}</td>
                                        <td>
                                            <!-- Badge dinámico para el estado -->
                                            <span 
                                                class="badge" 
                                                style="background-color: {{ $proyecto->estado == 1 ? '#28a745' : '#6c757d' }}; color: #fff;">
                                                {{ $proyecto->estado == 1 ? 'Activo' : 'Inactivo' }}
                                            </span>

                                        </td>
                                        <td>
                                            <button 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?')" 
                                                wire:click="eliminarProyecto({{ $proyecto->id }})">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (session()->has('message'))
                            <div class="alert alert-success mt-2">{{ session('message') }}</div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cerrarModal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
