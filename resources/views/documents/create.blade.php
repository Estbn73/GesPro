@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir Documento</div>

                <div class="card-body">
                <form action="{{ route('proyectos.documents.store', $proyecto) }}" method="POST" enctype="multipart/form-data">                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Documento:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Seleccionar Documento:</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Subir Documento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection