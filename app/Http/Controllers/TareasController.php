<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TareasController extends Controller
{
    public function index(){
        //$tareas = Tarea::all();
        return view('admin.index');
    }

    public function create(){
        return view('admin.create');
    }
    public function store(){

    }
}
