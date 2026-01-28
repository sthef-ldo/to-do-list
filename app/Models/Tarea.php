<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'tarea',
        'descripcion',
        'prioridad',
        'fecha_vencimiento',
        'estado',
        'user_id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //Relacion uno a muchos inversa (user -> tareas)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
