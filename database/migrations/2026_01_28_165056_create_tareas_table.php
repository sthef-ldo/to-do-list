<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('tarea');
            $table->text('descripcion')->nullable();
            $table->enum('prioridad', ['sin_prioridad', 'baja', 'media', 'alta'])->default('sin_prioridad');
            $table->dateTime('fecha_vencimiento')->nullable(); 
            $table->boolean('estado')->default(false); //terminada = 1 No terminada = 0
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('grupo_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
