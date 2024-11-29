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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_path');
            $table->unsignedBigInteger('proyecto_id'); // Relación con la tabla proyectos
            $table->timestamps();

            // Clave foránea
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'proyecto_id')) {
                $table->dropForeign(['proyecto_id']); // Intenta eliminar la clave solo si existe
                $table->dropColumn('proyecto_id'); // Elimina la columna si existe
            }
        });
    
        Schema::dropIfExists('documents');
    }
    
};
