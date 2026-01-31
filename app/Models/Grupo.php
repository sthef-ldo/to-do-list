<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = [
        'nombre',
        'user_id'
    ];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //relacion uno a muchos (grupo -> tareas)
    public function tareas(){
        return $this->hasMany(Tarea::class);
    }
    //relacion uno a muchos inversa (user -> grupos)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
