<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImpactoColumnInRiesgosTable extends Migration
{
    public function up()
    {
        Schema::table('riesgos', function (Blueprint $table) {
            $table->string('impacto', 50)->change(); // Cambia a VARCHAR(50)
        });
    }

    public function down()
    {
        Schema::table('riesgos', function (Blueprint $table) {
            $table->integer('impacto')->change(); // Revertir a INTEGER si es necesario
        });
    }
}

