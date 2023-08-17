<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambioEstadoContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio_estado_contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();
            $table->integer('estado_id')->nullable();
            $table->string('fecha')->nullable();
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
        Schema::dropIfExists('cambio_estado_contratos');
    }
}
