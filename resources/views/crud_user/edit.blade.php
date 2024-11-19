@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Usuario: {{ $user->name }}</div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <select name="rol" class="form-select" required>
                                <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user" {{ $user->rol == 'user' ? 'selected' : '' }}>Usuario</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="proyectos" class="form-label">Proyectos Asignados:</label>
                            <button type="button" id="toggle-projects" class="btn btn-secondary mb-2">Seleccionar Proyectos</button>
                            <div id="projects-container" style="display: none;">
                            @foreach($proyectos as $proyecto)
                                <div class="form-check">
                                    <!-- Campo oculto para enviar valor vacío si no está marcado -->
                                    <input type="hidden" name="proyectos[{{ $proyecto->id }}][id]" value="">
                                    
                                    <!-- Checkbox del Proyecto -->
                                    <input type="checkbox" 
                                        name="proyectos[{{ $proyecto->id }}][id]" 
                                        value="{{ $proyecto->id }}" 
                                        id="proyecto_{{ $proyecto->id }}" 
                                        class="form-check-input"
                                        {{ $user->proyectos->contains($proyecto) ? 'checked' : '' }}>
                                    <label for="proyecto_{{ $proyecto->id }}" class="form-check-label">{{ $proyecto->nombre }}</label>

                                    <!-- Selección del Rol en el Proyecto -->
                                    <select name="proyectos[{{ $proyecto->id }}][rol]" class="form-select mt-1">
                                        <option value="" disabled>Selecciona un rol</option>
                                        <option value="1" {{ $user->proyectos->contains($proyecto->id) && $user->proyectos->find($proyecto->id)->pivot->lider ? 'selected' : '' }}>Líder</option>
                                        <option value="0" {{ $user->proyectos->contains($proyecto->id) && $user->proyectos->find($proyecto->id)->pivot->lider === 0 ? 'selected' : '' }}>Desarrollador</option>
                                    </select>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Mostrar/ocultar el contenedor de proyectos
document.getElementById('toggle-projects').addEventListener('click', function() {
    const container = document.getElementById('projects-container');
    container.style.display = container.style.display === 'none' ? 'block' : 'none';
});
</script>

@endsection