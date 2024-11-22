<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProyectoIdToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Verifica si la columna ya existe antes de agregarla
            if (!Schema::hasColumn('documents', 'proyecto_id')) {
                $table->foreignId('proyecto_id')->constrained()->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Verifica si la columna existe antes de eliminarla
            if (Schema::hasColumn('documents', 'proyecto_id')) {
                $table->dropForeign(['proyecto_id']);
                $table->dropColumn('proyecto_id');
            }
        });
    }
}
