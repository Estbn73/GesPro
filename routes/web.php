<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudUsersController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RiesgoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\NotaController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/user/home', [UserController::class, 'index'])->name('user.home');

    Route::resource('users', CrudUsersController::class);

    // Rutas para gestión de proyectos y sus recursos relacionados
    Route::resource('proyectos', ProyectoController::class);

    // Rutas relacionadas a documentos, asociadas a proyectos
    Route::resource('proyectos.documents', DocumentController::class)->shallow();
    Route::get('documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');


    // Rutas para asignar usuario a un proyecto
    Route::post('/proyecto/{proyecto}/asignar-usuario', [UserController::class, 'asignarUsuario'])->name('proyecto.asignar.usuario');

    // CRUD completo para tareas, riesgos, presupuesto y notas, usando recursos anidados
    Route::resource('proyectos.tareas', TareaController::class)->shallow();
    Route::resource('proyectos.riesgos', RiesgoController::class)->shallow();
    Route::resource('proyectos.presupuesto', PresupuestoController::class)->shallow();
    Route::resource('proyectos.notas', NotaController::class);
    
    // Rutas adicionales para vista de carga dinámica de cada sección (si necesitas)
    Route::get('/proyectos/{proyecto}/{section}/{view}', [ProyectoController::class, 'loadSectionView'])->name('proyectos.section.view');
    Route::get('/proyectos/{proyecto}/{section}/{view}', [NotaController::class, 'showSectionView'])->name('proyectos.section.view');

});
