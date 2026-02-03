<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\PomodoroController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

// Rutas autenticadas
Route::middleware('auth')->group(function () {

    // Ruta para la gestión de grupos
    Route::resource('grupos', GruposController::class);

    // Rutas para la gestión de tareas (solo vistas)
    Route::get('/tareas/{grupo}', [TareasController::class, 'index'])->name('tareas.index');
    Route::get('/tareas/create/{grupo}', [TareasController::class, 'create'])->name('tareas.create');
    Route::get('/tareas/detalles/{tarea}', [TareasController::class, 'show'])->name('tareas.show');

    // Rutas REST de tareas (sin index, create, show)
    Route::resource('tareas', TareasController::class)->except('index', 'create', 'show');

    // Cambiar estado de tarea
    Route::post('tareas/{tarea}/toggle', [TareasController::class, 'toggleEstado'])->name('tareas.toggle');

    // Pomodoro
    Route::resource('pomodoro', PomodoroController::class);
});

require __DIR__ . '/settings.php';
