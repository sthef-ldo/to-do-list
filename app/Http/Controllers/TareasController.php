<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareasController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();
        return view('admin.index', compact('tareas'));
    }

    public function show($tarea)
    {
        $tarea = Tarea::findOrFail($tarea);
        return view('admin.show', compact('tarea'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'nullable|in:sin_prioridad,baja,media,alta',
            'fecha_vencimiento' => 'nullable|date',
            'estado' => 'nullable|boolean',
        ]);

        $data['prioridad'] = $data['prioridad'] ?? 'sin_prioridad';
        $data['estado'] = $data['estado'] ?? false;
        $data['user_id'] = auth('web')->id();

        Tarea::create($data);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function edit($tarea)
    {
        $tarea = Tarea::findOrFail($tarea);
        return view('admin.edit', compact('tarea'));
    }

    public function update(Request $request, $tarea)
    {
        $data = $request->validate([
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'nullable|in:sin_prioridad,baja,media,alta',
            'fecha_vencimiento' => 'nullable|date',
            'estado' => 'nullable|boolean',
        ]);

        $data['prioridad'] = $data['prioridad'] ?? 'sin_prioridad';
        $data['estado'] = $data['estado'] ?? false;
        $data['user_id'] = auth('web')->id();

        $tarea = Tarea::findOrFail($tarea);
        $tarea->update($data);
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy($tarea)
    {
        $tarea = Tarea::findOrFail($tarea);
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }



    public function toggleEstado($tareaId)
    {
        $tarea = Tarea::findOrFail($tareaId);
        $tarea->estado = !$tarea->estado;
        $tarea->save();

        
        return redirect()->back()->with('success', 'Estado actualizado.');
    }
}
