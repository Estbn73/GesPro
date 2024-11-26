<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->string('prioridad', 50)->nullable();
            $table->date('fecha_final')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropColumn(['prioridad', 'fecha_final']);
        });
    }

};
