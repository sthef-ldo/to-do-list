<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\GruposController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    /* prueba */
Route::get('/tareas/{grupo}', [TareasController::class, 'index'])->name('tareas.index');
Route::get('/tareas/create/{grupo}', [TareasController::class, 'create'])->name('tareas.create');
Route::get('/tareas/detalles/{tarea}', [TareasController::class, 'show'])->name('tareas.show');


//Rutas para la gestión de tareas
Route::resource('tareas', TareasController::class)->except('index', 'create','show');
//Tarea: Permitir cambiar el estado de una tarea (completada/no completada)
Route::post('tareas/{tarea}/toggle', [TareasController::class, 'toggleEstado'])->name('tareas.toggle');

//Ruta para la gestion de grupos
Route::resource('grupos', GruposController::class);


require __DIR__.'/settings.php';


