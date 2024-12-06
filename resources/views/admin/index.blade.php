@extends('layouts.app')

@section('content')
    <h1>Bienvenido, Administrador!</h1>
    <div id="user-management-container"></div>
@endsection

@section('scripts')
    <script>
        document.getElementById('manage-users').addEventListener('click', function() {
            loadUserManagement();
        });

        function loadUserManagement() {
            fetch('{{ route("users.index") }}')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-management-container').innerHTML = html;
                })
                .catch(error => console.error('Error loading user management:', error));
        }

        document.getElementById('manage-projects').addEventListener('click', function() {
            loadProjectManagement();
        });

        function loadProjectManagement() {
            fetch('{{ route("proyectos.index") }}')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-management-container').innerHTML = html;
                })
                .catch(error => console.error('Error al cargar la gestión de proyectos:', error));
        }

        document.getElementById('manage-documents').addEventListener('click', function() {
            loadDocumentManagement();
        });

        function loadDocumentManagement() {
            fetch('{{ route("documents.index") }}')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-management-container').innerHTML = html;
                })
                .catch(error => console.error('Error al cargar la gestión de documentos:', error));
        }

        document.getElementById('manage-tareas').addEventListener('click', function() {
            loadTaskManagement();
        });

        function loadTaskManagement() {
            fetch('{{ route("tareas.index") }}')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-management-container').innerHTML = html;
                })
                .catch(error => console.error('Error al cargar la gestión de tareas:', error));
        }
    </script>
@endsection
