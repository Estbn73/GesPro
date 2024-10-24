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

                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection