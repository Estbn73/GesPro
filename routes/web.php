<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudUsersController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/index', [AdminController::class, 'index'])->middleware('auth');
Route::get('/user/home', [UserController::class, 'index'])->middleware('auth');
Route::resource('users', CrudUsersController::class);
Route::resource('proyectos', ProyectoController::class);
Route::resource('documents', DocumentController::class);
Route::get('documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
Route::post('/proyecto/{proyectoId}/asignar-usuario', [UserController::class, 'asignarUsuario'])->middleware('auth')->name('asignar.usuario');
