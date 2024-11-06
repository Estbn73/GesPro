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
            $table->string('nombre_tarea');
            $table->text('descripcion');
            $table->unsignedBigInteger('proyecto_id'); // Clave foránea a proyectos
            $table->timestamps();
        
            // Definimos la clave foránea
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
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
