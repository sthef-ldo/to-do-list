<?php

namespace App\Http\Controllers;
use App\Models\Grupo;

use Illuminate\Support\Facades\Auth;  // ← AGREGAR ESTA LÍNEA
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()  {
       $grupos = Grupo::where('user_id', Auth::id())->paginate(9);
        return view('grupo.index', compact('grupos'));
    }
    public function store(Request $request){

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $data['user_id'] = auth('web')->id();

        Grupo::create($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado exitosamente.');

    }
    public function update(Request $request, Grupo $grupo){

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $grupo->update($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado exitosamente.');

    }
    public function destroy(Grupo $grupo){

        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado exitosamente.');
    }

}
