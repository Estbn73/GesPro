@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Usuario</div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <select name="rol" class="form-select" required>
                                <option value="admin">Administrador</option>
                                <option value="user">Usuario</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

