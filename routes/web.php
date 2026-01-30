<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('tareas', TareasController::class);

Route::post('tareas/{tarea}/toggle', [TareasController::class, 'toggleEstado'])->name('tareas.toggle');

require __DIR__.'/settings.php';
