<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoContratosTable extends Migration
{

    public function up()
    {
        Schema::create('tipo_contratos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_contratos');
    }
}
