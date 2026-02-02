<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;

use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function index() {
        $grupos = Grupo::where('user_id', Auth::id())->get();
            $tareas = Tarea::where('user_id', Auth::id())->get(); // Agrega esto

        return view('pomodoro.index', compact('grupos'));
    }

}
