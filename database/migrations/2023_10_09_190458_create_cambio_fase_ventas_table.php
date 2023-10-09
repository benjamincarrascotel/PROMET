<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambioFaseVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio_fase_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('venta_id')->nullable();
            $table->integer('etapa')->nullable();
            $table->string('fecha')->nullable();
            $table->string('fase_anterior')->nullable();
            $table->string('fase_actual')->nullable();
            $table->string('encargado')->nullable();
            $table->string('firma')->nullable();
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
        Schema::dropIfExists('cambio_fase_ventas');
    }
}
