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
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//Recuperar Contraseña 
Route::get('/password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/user/home', [UserController::class, 'index'])->name('user.home');

    Route::resource('users', CrudUsersController::class);

    // Rutas para gestión de proyectos y sus recursos relacionados
    Route::resource('proyectos', ProyectoController::class);
    Route::get('proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');

    // Rutas relacionadas a documentos, asociadas a proyectos
    Route::resource('proyectos.documents', DocumentController::class)->shallow();
    Route::get('documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('documents/view/{id}', [DocumentController::class, 'view'])->name('documents.view');
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

    // Rutas para el perfil de desarrollador
    Route::get('/user/miembros', [UserController::class, 'miembros'])->name('user.miembros');
    Route::get('/user/calendario', [UserController::class, 'calendario'])->name('user.calendario');
    Route::get('/eventos', [App\Http\Controllers\CalendarioController::class, 'obtenerEventos'])->name('eventos.obtener');


    Route::get('proyectos/tareas/{proyecto}', [ProyectoController::class, 'proyectoTareas'])->name('proyecto.tareas');
    Route::get('proyectos/riesgos/{proyecto}', [ProyectoController::class, 'proyectoRiesgos'])->name('proyecto.riesgos');


    // Rutas adicionales para vista de carga dinámica de cada sección (si necesitas)
    Route::get('/proyectos/{proyecto}/{section}/{view}', [ProyectoController::class, 'loadSectionView'])->name('proyectos.section.view');
    Route::get('/proyectos/{proyecto}/{section}/{view}', [NotaController::class, 'showSectionView'])->name('proyectos.section.view');


    //vistas livewire
    Route::get('proyectos/tareas/{proyecto}', [ProyectoController::class, 'proyectoTareas'])->name('proyecto.tareas');
    Route::get('proyectos/riesgos/{proyecto}', [ProyectoController::class, 'proyectoRiesgos'])->name('proyecto.riesgos');
    Route::get('proyectos/presupuestos/{proyecto}', [ProyectoController::class, 'proyectoPresupuestos'])->name('proyecto.presupuestos');
    Route::get('proyectos/notas/{proyecto}', [ProyectoController::class, 'proyectoNotas'])->name('proyecto.notas');
    Route::get('proyectos/notas/{proyecto}', [ProyectoController::class, 'proyectoNotas'])->name('proyecto.notas');
    Route::get('proyectos/documentos/{proyecto}', [ProyectoController::class, 'proyectoDocumentos'])->name('proyecto.documentos');
    Route::get('proyectos/equipos/{proyecto}', [ProyectoController::class, 'proyectoEquipos'])->name('proyecto.equipos');


    
});