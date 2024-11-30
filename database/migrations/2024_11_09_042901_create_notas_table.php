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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained()->onDelete('cascade'); // Relación con proyectos
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios
            $table->text('contenido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas', function (Blueprint $table) {
    
            if (Schema::hasColumn('notas', 'user_id')) {
                $table->dropForeign(['user_id']); // Elimina la clave foránea solo si existe
            }
        });
    
        Schema::dropIfExists('notas'); // Elimina la tabla
    }
    
    
};
