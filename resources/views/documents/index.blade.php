@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Gestión de Documentos</h2>
    <a href="{{ route('documents.create') }}" class="btn btn-primary">Subir Nuevo Documento</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ruta del Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documents as $document)
                <tr>
                    <td>{{ $document->name }}</td>
                    <td>{{ $document->file_path }}</td>
                    <td>
                        <a href="{{ route('documents.download', $document->id) }}" class="btn btn-info">Descargar</a>
                        <form action="{{ route('documents.destroy', $document) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay documentos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
